@props([
    'model' => null,
    'collection' => 'images',
    'max' => 8,
    'min' => 1,
    'featured' => true,
    'sortable' => true,
])

@php
    $existing = $model
        ? $model
            ->getMedia($collection)
            ->map(
                fn($m) => [
                    'id' => $m->id,
                    'url' => $m->getUrl('thumb'),
                    'full_url' => $m->getUrl(),
                    'name' => $m->file_name,
                    'is_featured' => (bool) $m->getCustomProperty('is_featured'),
                    'order' => $m->order_column,
                ],
            )
            ->sortBy('order')
            ->values()
            ->toArray()
        : [];
@endphp

<div x-data="mediaUploader({
    existing: {{ Js::from($existing) }},
    max: {{ $max }},
    min: {{ $min }},
    featuredEnabled: {{ Js::from($featured) }},
    sortableEnabled: {{ Js::from($sortable) }},
})" class="space-y-4">
    {{-- Hidden fields --}}
    <template x-for="id in deleteIds" :key="id">
        <input type="hidden" name="delete_media[]" :value="id">
    </template>
    <template x-for="(id, i) in orderedIds" :key="i">
        <input type="hidden" name="media_order[]" :value="id">
    </template>
    <input type="hidden" name="featured_media" :value="featuredValue">

    {{-- Dropzone --}}
    <div class="border-2 border-dashed border-base-300 rounded-box p-6 text-center transition-colors"
        :class="{ 'border-primary bg-primary/5': dragging }" @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false" @drop.prevent="onDrop($event)">
        <i class="icofont-cloud-upload text-4xl text-base-content/40" aria-hidden="true"></i>
        <p class="mt-2 text-sm text-base-content/60">
            {{ __('admin.media.drag_drop') }}
            <label class="link link-primary cursor-pointer">
                {{ __('admin.media.browse') }}
                <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/webp" class="sr-only"
                    @change="onFileInput($event)">
            </label>
        </p>
        <p class="mt-1 text-xs text-base-content/40">
            {{ __('admin.media.constraints', ['max' => $max, 'size' => '2MB']) }}
        </p>
        <p x-show="totalCount >= max" class="mt-1 text-xs text-warning">
            {{ __('admin.media.limit_reached', ['max' => $max]) }}
        </p>
    </div>

    {{-- Error slot --}}
    @error('images')
        <x-admin.ui.alert type="error">{{ $message }}</x-admin.ui.alert>
    @enderror
    @error('images.*')
        <x-admin.ui.alert type="error">{{ $message }}</x-admin.ui.alert>
    @enderror

    {{-- Gallery --}}
    <div x-show="existing.length > 0 || previews.length > 0"
        class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3" id="media-gallery">
        {{-- Existing media --}}
        <template x-for="(item, index) in existing" :key="item.id">
            <div class="relative group rounded-box overflow-hidden border border-base-300 bg-base-200"
                :class="{ 'ring-2 ring-primary': item.is_featured }" draggable="true"
                @dragstart="onDragStart($event, index, 'existing')"
                @dragover.prevent="onDragOver($event, index, 'existing')"
                @drop.prevent="onDropSort($event, index, 'existing')" @dragend="onDragEnd">
                <img :src="item.url" :alt="item.name" class="w-full h-28 object-cover">

                {{-- Featured badge --}}
                <template x-if="featuredEnabled && item.is_featured">
                    <span class="badge badge-primary badge-xs absolute top-1 left-1">
                        {{ __('admin.media.featured') }}
                    </span>
                </template>

                {{-- Actions overlay --}}
                <div
                    class="absolute inset-0 bg-base-300/70 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-between p-1">
                    <div class="flex justify-end">
                        <button type="button" class="btn btn-error btn-xs btn-square" @click="removeExisting(index)"
                            :title="'{{ __('admin.media.remove') }}'">
                            <i class="icofont-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="flex gap-1 justify-center">
                        <template x-if="sortableEnabled">
                            <button type="button" class="btn btn-ghost btn-xs" @click="moveExisting(index, -1)"
                                :disabled="index === 0">
                                <i class="icofont-arrow-left" aria-hidden="true"></i>
                            </button>
                        </template>
                        <template x-if="featuredEnabled && !item.is_featured">
                            <button type="button" class="btn btn-primary btn-xs"
                                @click="setFeatured('existing', index)">
                                <i class="icofont-star" aria-hidden="true"></i>
                            </button>
                        </template>
                        <template x-if="sortableEnabled">
                            <button type="button" class="btn btn-ghost btn-xs" @click="moveExisting(index, 1)"
                                :disabled="index === existing.length - 1">
                                <i class="icofont-arrow-right" aria-hidden="true"></i>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </template>

        {{-- New file previews --}}
        <template x-for="(preview, index) in previews" :key="index">
            <div class="relative group rounded-box overflow-hidden border border-base-300 bg-base-200"
                :class="{ 'ring-2 ring-primary': preview.is_featured }" draggable="true"
                @dragstart="onDragStart($event, index, 'new')" @dragover.prevent="onDragOver($event, index, 'new')"
                @drop.prevent="onDropSort($event, index, 'new')" @dragend="onDragEnd">
                <img :src="preview.url" :alt="preview.name" class="w-full h-28 object-cover">

                <span class="badge badge-accent badge-xs absolute top-1 left-1">
                    {{ __('admin.media.new') }}
                </span>
                <template x-if="featuredEnabled && preview.is_featured">
                    <span class="badge badge-primary badge-xs absolute top-1 right-1">
                        {{ __('admin.media.featured') }}
                    </span>
                </template>

                <div
                    class="absolute inset-0 bg-base-300/70 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-between p-1">
                    <div class="flex justify-end">
                        <button type="button" class="btn btn-error btn-xs btn-square" @click="removePreview(index)"
                            :title="'{{ __('admin.media.remove') }}'">
                            <i class="icofont-trash" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="flex gap-1 justify-center">
                        <template x-if="sortableEnabled">
                            <button type="button" class="btn btn-ghost btn-xs" @click="movePreview(index, -1)"
                                :disabled="index === 0">
                                <i class="icofont-arrow-left" aria-hidden="true"></i>
                            </button>
                        </template>
                        <template x-if="featuredEnabled && !preview.is_featured">
                            <button type="button" class="btn btn-primary btn-xs" @click="setFeatured('new', index)">
                                <i class="icofont-star" aria-hidden="true"></i>
                            </button>
                        </template>
                        <template x-if="sortableEnabled">
                            <button type="button" class="btn btn-ghost btn-xs" @click="movePreview(index, 1)"
                                :disabled="index === previews.length - 1">
                                <i class="icofont-arrow-right" aria-hidden="true"></i>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- Counter --}}
    <p class="text-xs text-base-content/50" x-show="totalCount > 0">
        <span x-text="totalCount"></span>/{{ $max }} {{ __('admin.media.images') }}
    </p>
</div>

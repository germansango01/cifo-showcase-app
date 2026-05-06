<x-layouts.admin :title="__('admin.projects.create')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'),   'href' => route('dashboard')],
        ['label' => __('admin.projects.title'),  'href' => route('projects.index')],
        ['label' => __('admin.projects.create')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.projects.create') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.projects.create_sub') }}</p>
    </div>

    <x-admin.ui.card class="max-w-3xl">
        <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6">

                {{-- course_id --}}
                <div class="sm:col-span-2">
                    <x-admin.ui.select
                        name="course_id"
                        :label="__('admin.projects.course')"
                        icon="icofont-book-alt"
                        :options="$courseOptions"
                        :placeholder="__('admin.projects.course_placeholder')"
                        :required="true" />
                </div>

                {{-- project_date --}}
                <x-admin.ui.input
                    name="project_date"
                    type="date"
                    :label="__('admin.projects.date')"
                    icon="icofont-calendar"
                    :required="true" />

                {{-- status --}}
                <x-admin.ui.select
                    name="status"
                    :label="__('admin.projects.status')"
                    icon="icofont-flag"
                    :options="[
                        'draft'     => __('admin.projects.status_draft'),
                        'pending'   => __('admin.projects.status_pending'),
                        'published' => __('admin.projects.status_published'),
                        'rejected'  => __('admin.projects.status_rejected'),
                    ]"
                    :selected="old('status', 'draft')"
                    :required="true" />

            </div>

            {{-- title[es] / title[ca] --}}
            <div class="space-y-1 mb-4">
                <p class="fieldset-legend">{{ __('admin.projects.title_field') }} <span class="text-error">*</span></p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">ES</span></legend>
                        <label class="input input-bordered w-full flex items-center gap-2 @error('title.es') input-error @enderror">
                            <i class="icofont-heading opacity-60"></i>
                            <input type="text" name="title[es]" id="title_es"
                                value="{{ old('title.es') }}" required class="grow" />
                        </label>
                        @error('title.es')
                            <p class="fieldset-label text-error flex items-center gap-1"><i class="icofont-warning-alt"></i> {{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">CA</span></legend>
                        <label class="input input-bordered w-full flex items-center gap-2 @error('title.ca') input-error @enderror">
                            <i class="icofont-heading opacity-60"></i>
                            <input type="text" name="title[ca]" id="title_ca"
                                value="{{ old('title.ca') }}" required class="grow" />
                        </label>
                        @error('title.ca')
                            <p class="fieldset-label text-error flex items-center gap-1"><i class="icofont-warning-alt"></i> {{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            {{-- description[es] / description[ca] --}}
            <div class="space-y-1 mb-4">
                <p class="fieldset-legend">{{ __('admin.projects.description') }}</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">ES</span></legend>
                        <textarea name="description[es]" id="description_es" rows="4"
                            class="textarea textarea-bordered w-full @error('description.es') textarea-error @enderror">{{ old('description.es') }}</textarea>
                        @error('description.es')
                            <p class="fieldset-label text-error flex items-center gap-1"><i class="icofont-warning-alt"></i> {{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">CA</span></legend>
                        <textarea name="description[ca]" id="description_ca" rows="4"
                            class="textarea textarea-bordered w-full @error('description.ca') textarea-error @enderror">{{ old('description.ca') }}</textarea>
                        @error('description.ca')
                            <p class="fieldset-label text-error flex items-center gap-1"><i class="icofont-warning-alt"></i> {{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            {{-- images --}}
            <fieldset class="fieldset w-full mb-4">
                <legend class="fieldset-legend">
                    {{ __('admin.projects.images') }} <span class="text-error">*</span>
                </legend>
                <x-admin.media.uploader
                    :model="null"
                    collection="images"
                    :max="8"
                    :min="1"
                    :featured="true"
                    :sortable="true"
                />
            </fieldset>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6">
                <x-admin.ui.input name="repo_url" type="url"
                    :label="__('admin.projects.repo_url')"
                    icon="icofont-code" />

                <x-admin.ui.input name="live_url" type="url"
                    :label="__('admin.projects.live_url')"
                    icon="icofont-globe" />

                {{-- published_at --}}
                <x-admin.ui.input name="published_at" type="datetime-local"
                    :label="__('admin.projects.published_at')"
                    icon="icofont-calendar" />

                {{-- featured --}}
                <fieldset class="fieldset w-full mb-4 justify-end flex flex-col">
                    <legend class="fieldset-legend">{{ __('admin.projects.featured') }}</legend>
                    <label class="flex items-center gap-3 cursor-pointer mt-2">
                        <input type="hidden" name="featured" value="0" />
                        <input type="checkbox" name="featured" value="1" class="toggle toggle-warning"
                            {{ old('featured') ? 'checked' : '' }} />
                        <span class="text-sm opacity-70">{{ __('admin.projects.featured') }}</span>
                    </label>
                </fieldset>
            </div>

            {{-- tags --}}
            @if ($tags->count())
                <fieldset class="fieldset w-full mb-4">
                    <legend class="fieldset-legend">{{ __('admin.projects.tags') }}</legend>
                    <div class="flex flex-wrap gap-2 mt-1">
                        @foreach ($tags as $tag)
                            <label class="flex items-center gap-1.5 cursor-pointer">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    class="checkbox checkbox-sm checkbox-primary"
                                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                                <span class="text-sm">{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>
            @endif

            <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('projects.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled">
                    {{ __('admin.projects.create_btn') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>

</x-layouts.admin>

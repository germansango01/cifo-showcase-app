<x-layouts.admin :title="__('admin.tags.edit') . ' · ' . $tag->name">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.tags.title'), 'href' => route('tags.index')],
        ['label' => $tag->name, 'href' => route('tags.index')],
        ['label' => __('admin.common.edit')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.tags.edit') }}</h1>
        <p class="text-sm opacity-70">
            <code class="bg-base-200 px-1.5 py-0.5 rounded text-xs">{{ $tag->slug }}</code>
        </p>
    </div>

    <x-admin.ui.card class="max-w-lg">
        <form method="POST" action="{{ route('tags.update', $tag) }}" novalidate x-data="{
            form: $form('patch', '{{ route('tags.update', $tag) }}', {
                name: '{{ addslashes($tag->name) }}'
            })
        }" @submit.prevent="form.submit({ onSuccess: () => window.location.href = '{{ route('tags.index') }}' })">
            @csrf
            @method('PATCH')

            <x-admin.ui.input
                name="name"
                :label="__('admin.tags.name')"
                icon="icofont-price"
                :value="$tag->name"
                :required="true"
                x-model="form.name"
                @change="form.validate('name')" />

            <div class="mt-4 flex flex-wrap gap-x-6 gap-y-1 text-xs opacity-50">
                <span><i class="icofont-calendar"></i> {{ __('admin.common.created_at') }}:
                    {{ $tag->created_at->format('d/m/Y H:i') }}</span>
                <span><i class="icofont-clock-time"></i> {{ __('admin.common.updated_at') }}:
                    {{ $tag->updated_at->format('d/m/Y H:i') }}</span>
            </div>

            <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('tags.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled" x-bind:loading="form.processing">
                    {{ __('admin.common.save_changes') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>

</x-layouts.admin>

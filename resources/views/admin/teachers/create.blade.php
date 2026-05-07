<x-layouts.admin :title="__('admin.teachers.create')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.teachers.title'), 'href' => route('teachers.index')],
        ['label' => __('admin.teachers.create')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.teachers.create') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.teachers.create_sub') }}</p>
    </div>

    <x-admin.ui.card class="max-w-lg">
        <form method="POST" action="{{ route('teachers.store') }}" novalidate
            x-data="{
                form: $form('post', '{{ route('teachers.store') }}', {
                    name: '',
                    email: ''
                })
            }"
            @submit.prevent="form.submit({ onSuccess: () => window.location.href = '{{ route('teachers.index') }}' })">
            @csrf

            <div class="space-y-4">
                <x-admin.ui.input name="name" :label="__('admin.teachers.col_name')" icon="icofont-user"
                    :placeholder="__('admin.teachers.name_placeholder')" :required="true"
                    x-model="form.name" @change="form.validate('name')" />

                <x-admin.ui.input name="email" :label="__('admin.teachers.col_email')" type="email" icon="icofont-mail"
                    :placeholder="__('admin.teachers.email_placeholder')" :required="true"
                    x-model="form.email" @change="form.validate('email')" />
            </div>

            <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('teachers.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled" x-bind:loading="form.processing">
                    {{ __('admin.teachers.create_btn') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>

</x-layouts.admin>

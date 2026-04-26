<x-layouts.admin :title="__('admin.courses.create')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'),   'href' => route('dashboard')],
        ['label' => __('admin.courses.title'),   'href' => route('courses.index')],
        ['label' => __('admin.courses.create')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.courses.create') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.courses.create_sub') }}</p>
    </div>

    <x-admin.ui.card class="max-w-lg">
        <form method="POST" action="{{ route('courses.store') }}" novalidate x-data="{
            form: $form('post', '{{ route('courses.store') }}', {
                category_id: '',
                course_code:  '',
                name:         ''
            })
        }" @submit.prevent="form.submit({ onSuccess: () => window.location.href = '{{ route('courses.index') }}' })">
            @csrf

            <x-admin.ui.select
                name="category_id"
                :label="__('admin.courses.category')"
                icon="icofont-folder"
                :options="$categoryOptions"
                :placeholder="__('admin.courses.category_placeholder')"
                :required="true"
                x-model="form.category_id"
                @change="form.validate('category_id')" />

            <x-admin.ui.input
                name="course_code"
                :label="__('admin.courses.code')"
                icon="icofont-tag"
                :placeholder="__('admin.courses.code_placeholder')"
                :required="true"
                x-model="form.course_code"
                @change="form.validate('course_code')" />

            <x-admin.ui.input
                name="name"
                :label="__('admin.courses.name')"
                icon="icofont-book-alt"
                :placeholder="__('admin.courses.name_placeholder')"
                :required="true"
                x-model="form.name"
                @change="form.validate('name')" />

            <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('courses.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled" x-bind:loading="form.processing">
                    {{ __('admin.courses.create_btn') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>

</x-layouts.admin>

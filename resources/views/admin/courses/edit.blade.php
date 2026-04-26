<x-layouts.admin :title="__('admin.courses.edit') . ' · ' . $course->course_code">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'),  'href' => route('dashboard')],
        ['label' => __('admin.courses.title'),  'href' => route('courses.index')],
        ['label' => $course->course_code,        'href' => route('courses.index')],
        ['label' => __('admin.common.edit')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.courses.edit') }}</h1>
        <p class="text-sm opacity-70">
            <code class="bg-base-200 px-1.5 py-0.5 rounded text-xs">{{ $course->course_code }}</code>
        </p>
    </div>

    <x-admin.ui.card class="max-w-lg">
        <form method="POST" action="{{ route('courses.update', $course) }}" novalidate x-data="{
            form: $form('patch', '{{ route('courses.update', $course) }}', {
                category_id: '{{ $course->category_id }}',
                course_code:  '{{ addslashes($course->course_code) }}',
                name:         '{{ addslashes($course->name) }}'
            })
        }" @submit.prevent="form.submit({ onSuccess: () => window.location.href = '{{ route('courses.index') }}' })">
            @csrf
            @method('PATCH')

            <x-admin.ui.select
                name="category_id"
                :label="__('admin.courses.category')"
                icon="icofont-folder"
                :options="$categoryOptions"
                :placeholder="__('admin.courses.category_placeholder')"
                :selected="$course->category_id"
                :required="true"
                x-model="form.category_id"
                @change="form.validate('category_id')" />

            <x-admin.ui.input
                name="course_code"
                :label="__('admin.courses.code')"
                icon="icofont-tag"
                :value="$course->course_code"
                :required="true"
                x-model="form.course_code"
                @change="form.validate('course_code')" />

            <x-admin.ui.input
                name="name"
                :label="__('admin.courses.name')"
                icon="icofont-book-alt"
                :value="$course->name"
                :required="true"
                x-model="form.name"
                @change="form.validate('name')" />

            <div class="mt-4 flex flex-wrap gap-x-6 gap-y-1 text-xs opacity-50">
                <span><i class="icofont-calendar"></i> {{ __('admin.common.created_at') }}:
                    {{ $course->created_at->format('d/m/Y H:i') }}</span>
                <span><i class="icofont-clock-time"></i> {{ __('admin.common.updated_at') }}:
                    {{ $course->updated_at->format('d/m/Y H:i') }}</span>
            </div>

            <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('courses.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled" x-bind:loading="form.processing">
                    {{ __('admin.common.save_changes') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>

</x-layouts.admin>

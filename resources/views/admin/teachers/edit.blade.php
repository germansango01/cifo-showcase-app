<x-layouts.admin :title="__('admin.teachers.edit') . ' · '. $teacher->name">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.teachers.title'), 'href' => route('teachers.index')],
        ['label' => $teacher->name],
        ['label' => __('admin.common.edit')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.teachers.edit') }}</h1>
        <p class="text-sm opacity-70">
            <code class="bg-base-200 px-1.5 py-0.5 rounded text-xs">{{ $teacher->name }}</code>
        </p>
    </div>

    <form method="POST" action="{{ route('teachers.update', $teacher) }}" novalidate class="space-y-6"
        x-data="{
            form: $form('patch', '{{ route('teachers.update', $teacher) }}', {
                name: @js($teacher->name),
                email: @js($teacher->email),
                courses: @js($selectedCourses).map(String)
            })
        }"
        @submit.prevent="form.submit({ onSuccess: () => window.location.href = '{{ route('teachers.index') }}' })">
        @csrf
        @method('PATCH')

        <x-admin.ui.card class="max-w-lg">
            <div class="space-y-4">
                <x-admin.ui.input name="name" :label="__('admin.teachers.col_name')" icon="icofont-user"
                    :required="true" x-model="form.name" @change="form.validate('name')" />

                <x-admin.ui.input name="email" :label="__('admin.teachers.col_email')" type="email" icon="icofont-mail"
                    :required="true" x-model="form.email" @change="form.validate('email')" />
            </div>

            <div class="mt-4 flex flex-wrap gap-x-6 gap-y-1 text-xs opacity-50">
                <span><i class="icofont-calendar"></i> {{ __('admin.common.created_at') }}:
                    {{ $teacher->created_at->format('d/m/Y H:i') }}</span>
                <span><i class="icofont-clock-time"></i> {{ __('admin.common.updated_at') }}:
                    {{ $teacher->updated_at->format('d/m/Y H:i') }}</span>
            </div>
        </x-admin.ui.card>

        @if ($courseOptions->count())
            <x-admin.ui.card class="max-w-lg">
                <h2 class="text-base font-semibold mb-1">{{ __('admin.teachers.courses') }}</h2>
                <p class="text-sm opacity-60 mb-3">{{ __('admin.teachers.courses_sub') }}</p>
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend sr-only">{{ __('admin.teachers.courses') }}</legend>
                    <div class="flex flex-wrap gap-2 mt-1">
                        @foreach ($courseOptions as $course)
                            <label class="cursor-pointer">
                                <input type="checkbox" value="{{ $course->id }}" class="peer sr-only"
                                    x-model="form.courses" />
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm border border-base-300
                                    peer-checked:bg-primary peer-checked:text-primary-content peer-checked:border-primary
                                    hover:border-primary transition-colors select-none">
                                    <code class="text-xs mr-1.5 opacity-60">{{ $course->course_code }}</code>
                                    {{ $course->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>
            </x-admin.ui.card>
        @endif

        <div class="max-w-lg flex justify-end gap-2 pt-2">
            <x-admin.ui.button variant="ghost" :href="route('teachers.index')">
                {{ __('admin.common.cancel') }}
            </x-admin.ui.button>
            <x-admin.ui.button type="submit" icon="icofont-check-circled" x-bind:loading="form.processing">
                {{ __('admin.common.save_changes') }}
            </x-admin.ui.button>
        </div>

    </form>

</x-layouts.admin>

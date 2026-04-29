<x-layouts.admin :title="__('admin.courses.edit') . ' · ' . $course->course_code">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'),  'href' => route('dashboard')],
        ['label' => __('admin.courses.title'),  'href' => route('courses.index')],
        ['label' => $course->course_code],
        ['label' => __('admin.common.edit')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.courses.edit') }}</h1>
        <p class="text-sm opacity-70">
            <code class="bg-base-200 px-1.5 py-0.5 rounded text-xs">{{ $course->course_code }}</code>
        </p>
    </div>

    <x-admin.ui.card class="max-w-lg">
        <form method="POST" action="{{ route('courses.update', $course) }}" novalidate>
            @csrf
            @method('PATCH')

            <x-admin.ui.select
                name="category_id"
                :label="__('admin.courses.category')"
                icon="icofont-folder"
                :options="$categoryOptions"
                :placeholder="__('admin.courses.category_placeholder')"
                :selected="$course->category_id"
                :required="true" />

            <x-admin.ui.input
                name="course_code"
                :label="__('admin.courses.code')"
                icon="icofont-tag"
                :value="$course->course_code"
                :required="true" />

            {{-- name[es] / name[ca] --}}
            <div class="space-y-1 mb-4">
                <p class="fieldset-legend">{{ __('admin.courses.name') }} <span class="text-error">*</span></p>
                <div class="grid grid-cols-2 gap-3">
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">ES</span></legend>
                        <label class="input input-bordered w-full flex items-center gap-2 @error('name.es') input-error @enderror">
                            <i class="icofont-book-alt opacity-60"></i>
                            <input type="text" name="name[es]" id="name_es"
                                value="{{ old('name.es', $course->getTranslation('name', 'es', false)) }}"
                                required class="grow" />
                        </label>
                        @error('name.es')
                            <p class="fieldset-label text-error flex items-center gap-1">
                                <i class="icofont-warning-alt"></i> {{ $message }}
                            </p>
                        @enderror
                    </fieldset>

                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">CA</span></legend>
                        <label class="input input-bordered w-full flex items-center gap-2 @error('name.ca') input-error @enderror">
                            <i class="icofont-book-alt opacity-60"></i>
                            <input type="text" name="name[ca]" id="name_ca"
                                value="{{ old('name.ca', $course->getTranslation('name', 'ca', false)) }}"
                                required class="grow" />
                        </label>
                        @error('name.ca')
                            <p class="fieldset-label text-error flex items-center gap-1">
                                <i class="icofont-warning-alt"></i> {{ $message }}
                            </p>
                        @enderror
                    </fieldset>
                </div>
            </div>

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
                <x-admin.ui.button type="submit" icon="icofont-check-circled">
                    {{ __('admin.common.save_changes') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>

</x-layouts.admin>

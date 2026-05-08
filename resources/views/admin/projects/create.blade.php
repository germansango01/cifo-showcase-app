<x-layouts.admin :title="__('admin.projects.create')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.projects.title'), 'href' => route('admin.projects.index')],
        ['label' => __('admin.projects.create')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.projects.create') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.projects.create_sub') }}</p>
    </div>

    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" novalidate
        class="space-y-6"
        x-data="{ filesHaveErrors: false }"
        @files-url-validity.window="filesHaveErrors = $event.detail.hasErrors">
        @csrf

        {{-- ── (a) Translatable texts ── --}}
        <x-admin.ui.card>
            <h2 class="text-lg font-semibold mb-1">{{ __('admin.projects.section_texts') }}</h2>
            <p class="text-sm opacity-60 mb-4">{{ __('admin.projects.section_texts_sub') }}</p>
            @include('admin.projects._partials._translatable-tabs', ['model' => null])
        </x-admin.ui.card>

        {{-- ── (b) Images ── --}}
        <x-admin.ui.card>
            <h2 class="text-lg font-semibold mb-1">{{ __('admin.projects.section_images') }}</h2>
            <p class="text-sm opacity-60 mb-4">{{ __('admin.projects.section_images_sub') }}</p>
            <fieldset class="fieldset w-full">
                <legend class="fieldset-legend sr-only">{{ __('admin.projects.images') }}</legend>
                <x-admin.media.uploader :model="null" collection="images" :max="8" :min="1"
                    :featured="true" :sortable="true" />
            </fieldset>
        </x-admin.ui.card>

        {{-- ── (c) Metadata ── --}}
        <x-admin.ui.card>
            <h2 class="text-lg font-semibold mb-1">{{ __('admin.projects.section_metadata') }}</h2>
            <p class="text-sm opacity-60 mb-4">{{ __('admin.projects.section_metadata_sub') }}</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6">

                <div class="md:col-span-2 lg:col-span-1">
                    <x-admin.ui.select name="course_id" :label="__('admin.projects.course')" icon="icofont-book-alt"
                        :options="$courseOptions" :placeholder="__('admin.projects.course_placeholder')" :required="true" />
                </div>

                <x-admin.ui.select name="status" :label="__('admin.projects.status')" icon="icofont-flag" :options="[
                    'draft'     => __('admin.projects.status_draft'),
                    'pending'   => __('admin.projects.status_pending'),
                    'published' => __('admin.projects.status_published'),
                    'rejected'  => __('admin.projects.status_rejected'),
                ]" :selected="old('status', 'draft')" :required="true" />

                <x-admin.ui.input name="project_date" type="month" :label="__('admin.projects.date')"
                    icon="icofont-calendar" :required="true" />

                <x-admin.ui.input name="repo_url" type="url" :label="__('admin.projects.repo_url')"
                    icon="icofont-code" />

                <x-admin.ui.input name="live_url" type="url" :label="__('admin.projects.live_url')"
                    icon="icofont-globe" />

                @if ($students->count())
                    <div class="col-span-full">
                        <x-admin.ui.select-multiple
                            name="students"
                            :label="__('admin.projects.students')"
                            icon="icofont-students-alt"
                            :options="$students->pluck('name', 'id')->all()"
                            :search-placeholder="__('admin.students.search_placeholder')"
                            :help="__('admin.projects.section_students_sub')" />
                    </div>
                @endif

            </div>
        </x-admin.ui.card>

        {{-- ── (d) Featured + Tags ── --}}
        <x-admin.ui.card>
            <h2 class="text-lg font-semibold mb-1">{{ __('admin.projects.section_featured_tags') }}</h2>
            <p class="text-sm opacity-60 mb-4">{{ __('admin.projects.section_featured_tags_sub') }}</p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend">{{ __('admin.projects.featured') }}</legend>
                    <label class="flex items-center gap-3 cursor-pointer mt-1">
                        <input type="hidden" name="featured" value="0" />
                        <input type="checkbox" name="featured" value="1" class="toggle toggle-warning"
                            {{ old('featured') ? 'checked' : '' }} />
                        <span class="text-sm opacity-70">{{ __('admin.projects.featured_hint') }}</span>
                    </label>
                </fieldset>

                @if ($tags->count())
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend">{{ __('admin.projects.tags') }}</legend>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach ($tags as $tag)
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="peer sr-only"
                                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm border border-base-300
                                        peer-checked:bg-primary peer-checked:text-primary-content peer-checked:border-primary
                                        hover:border-primary transition-colors select-none">
                                        {{ $tag->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                @endif
            </div>
        </x-admin.ui.card>

        {{-- ── (e) Reference files ── --}}
        <x-admin.ui.card>
            <h2 class="text-lg font-semibold mb-1">{{ __('admin.projects.section_files') }}</h2>
            <p class="text-sm opacity-60 mb-4">{{ __('admin.projects.section_files_sub') }}</p>
            @include('admin.projects._partials._files-section')
        </x-admin.ui.card>

        <div class="flex justify-end gap-2 pt-2">
            <x-admin.ui.button variant="ghost" :href="route('admin.projects.index')">
                {{ __('admin.common.cancel') }}
            </x-admin.ui.button>
            <x-admin.ui.button type="submit" icon="icofont-check-circled">
                {{ __('admin.projects.create_btn') }}
            </x-admin.ui.button>
        </div>

    </form>

</x-layouts.admin>

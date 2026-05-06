<x-layouts.admin :title="__('admin.projects.create')">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'), 'href' => route('dashboard')],
        ['label' => __('admin.projects.title'), 'href' => route('projects.index')],
        ['label' => __('admin.projects.create')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.projects.create') }}</h1>
        <p class="text-sm opacity-70">{{ __('admin.projects.create_sub') }}</p>
    </div>

    <x-admin.ui.card>
        <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

            {{-- ── Section Translatable texts (ES / CA tabs) ── --}}
            @include('admin.projects._partials._translatable-tabs', ['model' => null])

            {{-- ── Section Media uploader ── --}}
            <fieldset class="fieldset w-full mb-6">
                <legend class="fieldset-legend">
                    {{ __('admin.projects.images') }} <span class="text-error">*</span>
                </legend>
                <x-admin.media.uploader :model="null" collection="images" :max="8" :min="1"
                    :featured="true" :sortable="true" />
            </fieldset>

            {{-- ── Section Metadata ── --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6">

                {{-- course_id --}}
                <div class="md:col-span-2 lg:col-span-1">
                    <x-admin.ui.select name="course_id" :label="__('admin.projects.course')" icon="icofont-book-alt" :options="$courseOptions"
                        :placeholder="__('admin.projects.course_placeholder')" :required="true" />
                </div>

                {{-- status --}}
                <x-admin.ui.select name="status" :label="__('admin.projects.status')" icon="icofont-flag" :options="[
                    'draft' => __('admin.projects.status_draft'),
                    'pending' => __('admin.projects.status_pending'),
                    'published' => __('admin.projects.status_published'),
                    'rejected' => __('admin.projects.status_rejected'),
                ]"
                    :selected="old('status', 'draft')" :required="true" />

                {{-- project_date --}}
                <x-admin.ui.input name="project_date" type="date" :label="__('admin.projects.date')" icon="icofont-calendar"
                    :required="true" />

                {{-- repo_url --}}
                <x-admin.ui.input name="repo_url" type="url" :label="__('admin.projects.repo_url')" icon="icofont-code" />

                {{-- live_url --}}
                <x-admin.ui.input name="live_url" type="url" :label="__('admin.projects.live_url')" icon="icofont-globe" />

                {{-- published_at --}}
                <x-admin.ui.input name="published_at" type="datetime-local" :label="__('admin.projects.published_at')"
                    icon="icofont-calendar" />

            </div>

            {{-- featured toggle --}}
            <fieldset class="fieldset w-full mb-4">
                <legend class="fieldset-legend">{{ __('admin.projects.featured') }}</legend>
                <label class="flex items-center gap-3 cursor-pointer mt-1">
                    <input type="hidden" name="featured" value="0" />
                    <input type="checkbox" name="featured" value="1" class="toggle toggle-warning"
                        {{ old('featured') ? 'checked' : '' }} />
                    <span class="text-sm opacity-70">{{ __('admin.projects.featured_hint') }}</span>
                </label>
            </fieldset>

            {{-- ── Tags as chips ── --}}
            @if ($tags->count())
                <fieldset class="fieldset w-full mb-6">
                    <legend class="fieldset-legend">{{ __('admin.projects.tags') }}</legend>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach ($tags as $tag)
                            <label class="cursor-pointer">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="peer sr-only"
                                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm border border-base-300
                                    peer-checked:bg-primary peer-checked:text-primary-content peer-checked:border-primary
                                    hover:border-primary transition-colors select-none">
                                    {{ $tag->name }}
                                </span>
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

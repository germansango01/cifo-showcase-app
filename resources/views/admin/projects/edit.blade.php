<x-layouts.admin :title="__('admin.projects.edit') . ' · ' . $project->getTranslation('title', 'es', false)">
    <x-admin.ui.breadcrumb :items="[
        ['label' => __('admin.nav.dashboard'),  'href' => route('dashboard')],
        ['label' => __('admin.projects.title'), 'href' => route('projects.index')],
        ['label' => $project->getTranslation('title', 'es', false)],
        ['label' => __('admin.common.edit')],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ __('admin.projects.edit') }}</h1>
        <p class="text-sm opacity-70">
            <code class="bg-base-200 px-1.5 py-0.5 rounded text-xs">{{ $project->getTranslation('slug', 'es', false) }}</code>
        </p>
    </div>

    <x-admin.ui.card class="max-w-3xl">
        <form method="POST" action="{{ route('projects.update', $project) }}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6">

                {{-- course_id --}}
                <div class="sm:col-span-2">
                    <x-admin.ui.select
                        name="course_id"
                        :label="__('admin.projects.course')"
                        icon="icofont-book-alt"
                        :options="$courseOptions"
                        :placeholder="__('admin.projects.course_placeholder')"
                        :selected="$project->course_id"
                        :required="true" />
                </div>

                {{-- project_date --}}
                <x-admin.ui.input
                    name="project_date"
                    type="date"
                    :label="__('admin.projects.date')"
                    icon="icofont-calendar"
                    :value="$project->project_date->format('Y-m-d')"
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
                    :selected="old('status', $project->status)"
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
                                value="{{ old('title.es', $project->getTranslation('title', 'es', false)) }}"
                                required class="grow" />
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
                                value="{{ old('title.ca', $project->getTranslation('title', 'ca', false)) }}"
                                required class="grow" />
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
                            class="textarea textarea-bordered w-full @error('description.es') textarea-error @enderror">{{ old('description.es', $project->getTranslation('description', 'es', false)) }}</textarea>
                        @error('description.es')
                            <p class="fieldset-label text-error flex items-center gap-1"><i class="icofont-warning-alt"></i> {{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend"><span class="badge badge-xs badge-neutral">CA</span></legend>
                        <textarea name="description[ca]" id="description_ca" rows="4"
                            class="textarea textarea-bordered w-full @error('description.ca') textarea-error @enderror">{{ old('description.ca', $project->getTranslation('description', 'ca', false)) }}</textarea>
                        @error('description.ca')
                            <p class="fieldset-label text-error flex items-center gap-1"><i class="icofont-warning-alt"></i> {{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>
            </div>

            {{-- images --}}
            <fieldset class="fieldset w-full mb-4">
                <legend class="fieldset-legend">{{ __('admin.projects.images') }}</legend>
                <x-admin.media.uploader
                    :model="$project"
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
                    icon="icofont-code"
                    :value="$project->repo_url" />

                <x-admin.ui.input name="live_url" type="url"
                    :label="__('admin.projects.live_url')"
                    icon="icofont-globe"
                    :value="$project->live_url" />

                {{-- published_at --}}
                <x-admin.ui.input name="published_at" type="datetime-local"
                    :label="__('admin.projects.published_at')"
                    icon="icofont-calendar"
                    :value="$project->published_at?->format('Y-m-d\TH:i')" />

                {{-- featured --}}
                <fieldset class="fieldset w-full mb-4 justify-end flex flex-col">
                    <legend class="fieldset-legend">{{ __('admin.projects.featured') }}</legend>
                    <label class="flex items-center gap-3 cursor-pointer mt-2">
                        <input type="hidden" name="featured" value="0" />
                        <input type="checkbox" name="featured" value="1" class="toggle toggle-warning"
                            {{ old('featured', $project->featured) ? 'checked' : '' }} />
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
                                    {{ in_array($tag->id, old('tags', $selectedTags)) ? 'checked' : '' }} />
                                <span class="text-sm">{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>
            @endif

            <div class="mt-4 flex flex-wrap gap-x-6 gap-y-1 text-xs opacity-50">
                <span><i class="icofont-calendar"></i> {{ __('admin.common.created_at') }}:
                    {{ $project->created_at->format('d/m/Y H:i') }}</span>
                <span><i class="icofont-clock-time"></i> {{ __('admin.common.updated_at') }}:
                    {{ $project->updated_at->format('d/m/Y H:i') }}</span>
            </div>

            <div class="flex justify-end gap-2 mt-8 pt-4 border-t border-base-300">
                <x-admin.ui.button variant="ghost" :href="route('projects.index')">
                    {{ __('admin.common.cancel') }}
                </x-admin.ui.button>
                <x-admin.ui.button type="submit" icon="icofont-check-circled">
                    {{ __('admin.common.save_changes') }}
                </x-admin.ui.button>
            </div>
        </form>
    </x-admin.ui.card>

</x-layouts.admin>

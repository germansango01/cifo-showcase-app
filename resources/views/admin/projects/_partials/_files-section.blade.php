@php
$fileItems = old('files', isset($project)
    ? $project->files->map(fn ($f) => [
        'id'    => $f->id,
        'type'  => $f->type,
        'url'   => $f->url,
        'label' => [
            'es' => $f->getTranslation('label', 'es', false) ?? '',
            'ca' => $f->getTranslation('label', 'ca', false) ?? '',
        ],
    ])->values()->toArray()
    : []);

$typeOptions = [
    'link'         => __('admin.projects.file_type_link'),
    'pdf'          => __('admin.projects.file_type_pdf'),
    'document'     => __('admin.projects.file_type_document'),
    'spreadsheet'  => __('admin.projects.file_type_spreadsheet'),
    'presentation' => __('admin.projects.file_type_presentation'),
    'markdown'     => __('admin.projects.file_type_markdown'),
    'image'        => __('admin.projects.file_type_image'),
    'video'        => __('admin.projects.file_type_video'),
    'archive'      => __('admin.projects.file_type_archive'),
    'code'         => __('admin.projects.file_type_code'),
    'other'        => __('admin.projects.file_type_other'),
];
@endphp

<x-admin.forms.repeater name="files" :items="$fileItems">

    <template x-for="(row, index) in rows" :key="index">
        <div class="grid grid-cols-1 md:grid-cols-[140px_1fr_1fr_1fr_auto] gap-3 items-end p-3 bg-base-200 rounded-lg">

            <input type="hidden" :name="`files[${index}][id]`" :value="row.id ?? ''" />

            {{-- type --}}
            <div class="form-control">
                <label class="label pb-1">
                    <span class="label-text text-xs">{{ __('admin.projects.files_type') }}</span>
                </label>
                <select :name="`files[${index}][type]`" x-model="row.type" class="select select-bordered select-sm w-full">
                    @foreach ($typeOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- url --}}
            <div class="form-control">
                <label class="label pb-1">
                    <span class="label-text text-xs">{{ __('admin.projects.files_url') }} <span class="text-error">*</span></span>
                </label>
                <input
                    type="url"
                    :name="`files[${index}][url]`"
                    x-model="row.url"
                    class="input input-bordered input-sm w-full"
                    placeholder="https://"
                />
            </div>

            {{-- label ES --}}
            <div class="form-control">
                <label class="label pb-1">
                    <span class="label-text text-xs">{{ __('admin.projects.files_label_es') }}</span>
                </label>
                <input
                    type="text"
                    :name="`files[${index}][label][es]`"
                    x-model="row.label.es"
                    class="input input-bordered input-sm w-full"
                />
            </div>

            {{-- label CA --}}
            <div class="form-control">
                <label class="label pb-1">
                    <span class="label-text text-xs">{{ __('admin.projects.files_label_ca') }}</span>
                </label>
                <input
                    type="text"
                    :name="`files[${index}][label][ca]`"
                    x-model="row.label.ca"
                    class="input input-bordered input-sm w-full"
                />
            </div>

            {{-- remove --}}
            <div class="flex items-end pb-0.5">
                <button
                    type="button"
                    @click="removeRow(index)"
                    class="btn btn-sm btn-ghost btn-error"
                    :title="'{{ __('admin.projects.files_remove') }}'"
                    aria-label="{{ __('admin.projects.files_remove') }}"
                >
                    <i class="icofont-trash" aria-hidden="true"></i>
                </button>
            </div>

        </div>
    </template>

    <button
        type="button"
        @click="addRow({ type: 'link', url: '', label: { es: '', ca: '' } })"
        class="btn btn-sm btn-outline btn-primary mt-1"
    >
        <i class="icofont-plus" aria-hidden="true"></i>
        {{ __('admin.projects.files_add') }}
    </button>

</x-admin.forms.repeater>

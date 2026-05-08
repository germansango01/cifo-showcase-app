@php
use App\Enums\ProjectFileType;

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

$typeOptions = ProjectFileType::labels();

// Pass server-side URL errors to Alpine so they show inside x-for rows.
$urlErrors = [];
foreach (($errors->getMessages()) as $key => $msgs) {
    if (preg_match('/^files\.(\d+)\.url$/', $key, $m)) {
        $urlErrors[(int) $m[1]] = $msgs[0];
    }
}
@endphp

<div
    x-data="{
        rows: {{ Js::from(collect($fileItems)->values()->toArray()) }},
        urlErrors: {{ Js::from($urlErrors) }},
        addRow(defaults) { this.rows.push(Object.assign({ id: null }, defaults ?? {})); },
        removeRow(i) { this.rows.splice(i, 1); delete this.urlErrors[i]; },
        isValidUrl(val) { return /^https?:\/\/.+/.test(val ?? ''); }
    }"
>
    <template x-for="(row, index) in rows" :key="index">
        <div class="grid grid-cols-1 md:grid-cols-[140px_1fr_1fr_1fr_auto] gap-3 items-end p-3 bg-base-200 rounded-lg mb-2">

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
                    <span class="label-text text-xs">
                        {{ __('admin.projects.files_url') }} <span class="text-error">*</span>
                    </span>
                </label>
                <input
                    type="url"
                    :name="`files[${index}][url]`"
                    x-model="row.url"
                    required
                    placeholder="https://"
                    :class="(!isValidUrl(row.url) && row.url !== '') || urlErrors[index] ? 'input-error' : ''"
                    class="input input-bordered input-sm w-full"
                />
                <template x-if="urlErrors[index]">
                    <p class="label-text-alt text-error mt-0.5 flex items-center gap-1">
                        <i class="icofont-warning-alt" aria-hidden="true"></i>
                        <span x-text="urlErrors[index]"></span>
                    </p>
                </template>
                <template x-if="!urlErrors[index] && !isValidUrl(row.url) && row.url !== ''">
                    <p class="label-text-alt text-error mt-0.5">
                        {{ __('validation.url', ['attribute' => 'URL']) }}
                    </p>
                </template>
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
        @click="addRow({ type: 'pdf', url: '', label: { es: '', ca: '' } })"
        class="btn btn-sm btn-outline btn-primary mt-1"
    >
        <i class="icofont-plus" aria-hidden="true"></i>
        {{ __('admin.projects.files_add') }}
    </button>

</div>

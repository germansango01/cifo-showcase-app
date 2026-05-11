@props(['name', 'items' => []])

<div x-data="{
    rows: {{ Js::from(collect($items)->values()->toArray()) }},
    addRow(defaults) { this.rows.push(Object.assign({ id: null }, defaults ?? {})); },
    removeRow(i) { this.rows.splice(i, 1); }
}">
    {{ $slot }}
</div>

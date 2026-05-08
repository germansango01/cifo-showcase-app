/**
 * Alpine.js select2-style multi-select component.
 *
 * @param {{ options: Array<{value: string, text: string}>, selected: Array<string|number>, name: string }} config
 */
export default function selectMultiple({ options = [], selected = [], name = '' } = {}) {
    return {
        open: false,
        search: '',
        name,
        options,
        selected: (Array.isArray(selected) ? selected : []).map(String),

        get filteredOptions() {
            const q = this.search.trim().toLowerCase();
            if (!q) return this.options;
            return this.options.filter(o => o.text.toLowerCase().includes(q));
        },

        get hasSelection() {
            return this.selected.length > 0;
        },

        toggle() {
            this.open = !this.open;
            if (this.open) {
                this.$nextTick(() => this.$refs.search?.focus());
            }
        },

        close() {
            this.open = false;
            this.search = '';
        },

        isSelected(value) {
            return this.selected.includes(String(value));
        },

        toggleOption(value) {
            const v = String(value);
            const idx = this.selected.indexOf(v);
            if (idx >= 0) this.selected.splice(idx, 1);
            else this.selected.push(v);
        },

        remove(value) {
            const idx = this.selected.indexOf(String(value));
            if (idx >= 0) this.selected.splice(idx, 1);
        },

        clear() {
            this.selected = [];
        },

        labelFor(value) {
            const opt = this.options.find(o => String(o.value) === String(value));
            return opt ? opt.text : value;
        },
    };
}

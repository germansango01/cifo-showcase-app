/**
 * Alpine.js rich text editor component.
 *
 * @param {string} initialValue - HTML string to preload into the editor.
 * @param {string} inputId      - ID of the hidden <input> to keep in sync.
 */
export default function richEditor(initialValue = '', inputId = '') {
    return {
        focused: false,

        init() {
            const el = this.$refs.editable;
            if (initialValue) {
                el.innerHTML = initialValue;
            }
            this._syncHidden();
        },

        _syncHidden() {
            const input = document.getElementById(inputId);
            if (input) {
                input.value = this.$refs.editable.innerHTML;
            }
        },

        onInput() {
            this._syncHidden();
        },

        exec(command, value = null) {
            this.$refs.editable.focus();
            document.execCommand(command, false, value);
            this._syncHidden();
        },

        isActive(command) {
            return document.queryCommandState(command);
        },

        formatBlock(tag) {
            this.$refs.editable.focus();
            const current = document.queryCommandValue('formatBlock').toLowerCase();
            document.execCommand('formatBlock', false, current === tag ? 'p' : tag);
            this._syncHidden();
        },

        isBlock(tag) {
            return document.queryCommandValue('formatBlock').toLowerCase() === tag;
        },

        insertLink() {
            const url = window.prompt('URL:');
            if (url) this.exec('createLink', url);
        },

        clearFormat() {
            this.exec('removeFormat');
            this.exec('unlink');
        },
    };
}

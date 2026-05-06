/**
 * Alpine.js component for media upload management.
 *
 * Handles: drag&drop upload, preview, delete existing, reorder, set featured.
 *
 * @param {Object} config
 * @param {Array}  config.existing        - Already-saved media items from Spatie.
 * @param {number} config.max             - Maximum allowed images.
 * @param {number} config.min             - Minimum required images.
 * @param {boolean} config.featuredEnabled
 * @param {boolean} config.sortableEnabled
 */
export default function mediaUploader({
    existing = [],
    max = 8,
    min = 1,
    featuredEnabled = true,
    sortableEnabled = true,
} = {}) {
    return {
        existing,
        max,
        min,
        featuredEnabled,
        sortableEnabled,
        previews: [],   // { url, name, file, is_featured }
        newFiles: [],   // File[] in same order as previews
        deleteIds: [],
        dragging: false,
        dragSource: null, // { type: 'existing'|'new', index }

        get totalCount() {
            return this.existing.length + this.previews.length;
        },

        get orderedIds() {
            return this.existing.map(m => m.id);
        },

        get featuredValue() {
            const featExisting = this.existing.find(m => m.is_featured);
            if (featExisting) return String(featExisting.id);

            const featNewIdx = this.previews.findIndex(p => p.is_featured);
            if (featNewIdx !== -1) return `new:${featNewIdx}`;

            return '';
        },

        onFileInput(event) {
            const files = Array.from(event.target.files);
            event.target.value = '';
            this._addFiles(files);
        },

        onDrop(event) {
            this.dragging = false;
            const files = Array.from(event.dataTransfer.files).filter(f =>
                ['image/jpeg', 'image/png', 'image/webp'].includes(f.type)
            );
            this._addFiles(files);
        },

        _addFiles(files) {
            const remaining = max - this.totalCount;
            files.slice(0, remaining).forEach(file => {
                const url = URL.createObjectURL(file);
                this.previews.push({ url, name: file.name, file, is_featured: false });
                this.newFiles.push(file);
            });
            this._syncFileInput();
        },

        removeExisting(index) {
            const item = this.existing[index];
            this.deleteIds.push(item.id);
            this.existing.splice(index, 1);

            if (item.is_featured && this.existing.length > 0) {
                this.existing[0].is_featured = true;
            }
        },

        removePreview(index) {
            URL.revokeObjectURL(this.previews[index].url);
            this.previews.splice(index, 1);
            this.newFiles.splice(index, 1);
            this._syncFileInput();
        },

        setFeatured(type, index) {
            this.existing.forEach(m => (m.is_featured = false));
            this.previews.forEach(p => (p.is_featured = false));

            if (type === 'existing') {
                this.existing[index].is_featured = true;
            } else {
                this.previews[index].is_featured = true;
            }
        },

        moveExisting(index, direction) {
            const target = index + direction;
            if (target < 0 || target >= this.existing.length) return;
            [this.existing[index], this.existing[target]] = [this.existing[target], this.existing[index]];
        },

        // Drag-to-sort for existing images
        onDragStart(event, index, type) {
            this.dragSource = { type, index };
            event.dataTransfer.effectAllowed = 'move';
        },

        onDragOver(event, index, type) {
            if (this.dragSource && this.dragSource.type === type) {
                event.dataTransfer.dropEffect = 'move';
            }
        },

        onDropSort(event, targetIndex, type) {
            if (!this.dragSource || this.dragSource.type !== type) return;
            const from = this.dragSource.index;
            if (from === targetIndex) return;

            if (type === 'existing') {
                const item = this.existing.splice(from, 1)[0];
                this.existing.splice(targetIndex, 0, item);
            }
            this.dragSource = null;
        },

        onDragEnd() {
            this.dragSource = null;
        },

        // Keep a real FileList-equivalent on the hidden file input so the form submits the files.
        _syncFileInput() {
            const dt = new DataTransfer();
            this.newFiles.forEach(f => dt.items.add(f));
            const input = document.querySelector('input[name="images[]"][type="file"].sr-only');
            if (input) input.files = dt.files;
        },
    };
}

<div class="max-w-4xl mx-auto p-6 bg-base-100 shadow-xl rounded-2xl" x-data="imageManager({{ $project->getMedia('project_images')->map(fn($m) => ['id' => $m->id, 'url' => $m->getUrl('thumb')]) }})">

    <h2 class="text-2xl font-bold mb-6">Gestionar Imágenes del Proyecto</h2>

    <!-- Formulario de Carga -->
    <form action="{{ route('projects.images.store', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Dropzone Estilizada con DaisyUI -->
        <div class="form-control">
            <div class="relative border-2 border-dashed border-primary/40 rounded-xl p-10 group hover:bg-base-200 transition-all cursor-pointer" :class="isDragging ? 'border-primary bg-base-200' : ''" @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false" @drop.prevent="handleDrop($event)">

                <input type="file" name="images[]" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="previewLocalFiles($event.target.files)">

                <div class="text-center space-y-2">
                    <svg class="w-12 h-12 mx-auto text-primary opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <p class="text-lg">Arrastra imágenes o <span class="text-primary font-bold">haz clic aquí</span></p>
                    <p class="text-xs opacity-50">JPG, PNG o WEBP (Máx. 2MB por archivo)</p>
                </div>
            </div>
        </div>

        <!-- Previsualización de archivos NUEVOS (Alpine) -->
        <template x-if="localPreviews.length > 0">
            <div class="bg-secondary/5 p-4 rounded-lg">
                <p class="text-sm font-semibold mb-3 text-secondary">Nuevas imágenes seleccionadas:</p>
                <div class="grid grid-cols-3 md:grid-cols-5 gap-4">
                    <template x-for="(src, index) in localPreviews" :key="index">
                        <div class="relative">
                            <img :src="src" class="w-full h-24 object-cover rounded-lg ring-2 ring-secondary shadow-lg">
                        </div>
                    </template>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary btn-block">Subir todas las imágenes</button>
                </div>
            </div>
        </template>
    </form>

    <div class="divider">Imágenes en el servidor</div>

    <!-- Galería de imágenes EXISTENTES (Spatie) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <template x-for="media in serverImages" :key="media.id">
            <div class="relative group aspect-square overflow-hidden rounded-xl shadow-md bg-base-300">
                <img :src="media.url" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <button @click="deleteMedia(media.id)" class="btn btn-error btn-sm btn-circle">
                        ✕
                    </button>
                </div>
            </div>
        </template>
    </div>
</div>

<script>
    function imageManager(initialImages) {
        return {
            serverImages: initialImages
            , localPreviews: []
            , isDragging: false,

            // Previsualizar antes de subir
            previewLocalFiles(files) {
                this.localPreviews = [];
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = (e) => this.localPreviews.push(e.target.result);
                    reader.readAsDataURL(file);
                });
            },

            handleDrop(e) {
                this.isDragging = false;
                const files = e.dataTransfer.files;
                this.$el.querySelector('input[type="file"]').files = files;
                this.previewLocalFiles(files);
            },

            // Eliminar del servidor vía AJAX
            async deleteMedia(id) {
                if (!confirm('¿Seguro que quieres borrar esta imagen?')) return;

                try {
                    const response = await fetch(`/media/${id}`, {
                        method: 'DELETE'
                        , headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            , 'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        this.serverImages = this.serverImages.filter(img => img.id !== id);
                    }
                } catch (error) {
                    console.error("Error eliminando:", error);
                }
            }
        }
    }

</script>

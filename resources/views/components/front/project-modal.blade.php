{{--
 * resources/views/components/front/project-modal.blade.php
 *
 * Project quick-view modal — populated client-side by modal.js.
 * Include once per page that has project cards.
 --}}

<div class="modal" id="project-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title" aria-hidden="true">

    <div class="modal-backdrop"></div>

    <div class="modal-dialog">

        {{-- Close button --}}
        <button class="modal-close" id="modal-close-btn" aria-label="{{ __('Cerrar modal') }}">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                <path d="M1 1l16 16M17 1L1 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
        </button>

        {{-- Image carousel --}}
        <div class="carousel modal-carousel" id="modal-carousel" role="region" aria-label="{{ __('Galería de imágenes del proyecto') }}">
            <div class="carousel-track" id="carousel-track"></div>

            <button class="carousel-btn" data-direction="prev" aria-label="{{ __('Imagen anterior') }}">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                    <path d="M12 4L6 10l6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
            <button class="carousel-btn" data-direction="next" aria-label="{{ __('Imagen siguiente') }}">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                    <path d="M8 4l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>

            <div class="carousel-dots" id="carousel-dots" role="tablist" aria-label="{{ __('Seleccionar imagen') }}"></div>
        </div>

        {{-- Project info — populated by JS --}}
        <div class="modal-content">
            <div class="modal-badges" id="modal-badges"></div>
            <h2 id="modal-title"></h2>
            <p id="modal-description"></p>
            <dl class="modal-meta" id="modal-meta"></dl>
            <div id="modal-technologies"></div>
            <div id="modal-tags"></div>
            <a href="#" class="btn modal-cta" data-variant="primary" id="modal-detail-link">
                {{ __('Ver proyecto completo →') }}
            </a>
        </div>

    </div>
</div>

<?php

namespace App\View\Components\Admin\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Actions extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $editHref     = null,
        public ?string $showHref     = null,
        public ?string $deleteAction = null,   // URL del form DELETE
        public int|string|null $deleteId = null, // ID único para el modal
    ) {}
 
    /** Unique modal ID derived from deleteId or a random fallback. */
    public function modalId(): string
    {
        return 'delete-modal-' . ($this->deleteId ?? uniqid());
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.table.actions');
    }
}

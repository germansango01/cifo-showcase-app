<?php

namespace App\View\Components\Admin\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyState extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $message,
        public string $icon = 'icofont-search-1',
        public ?string $actionLabel = null,
        public ?string $actionHref = null,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.table.empty-state');
    }
}

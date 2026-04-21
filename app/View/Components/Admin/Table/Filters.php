<?php

namespace App\View\Components\Admin\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filters extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $action,
        public string $searchPlaceholder = 'Buscar…',
    ) {
    }

    /**
     * Query params to preserve as hidden inputs (exclude 'search' and 'page').
     *
     * @return array<string, string>
     */
    public function preserved(): array
    {
        return collect(request()->query())
            ->except(['search', 'page', '_token'])
            ->map(fn ($v) => (string) $v)
            ->all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.table.filters');
    }
}

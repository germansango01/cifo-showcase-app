<?php

namespace App\View\Components\Admin\Table;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Index extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public mixed $items,
        public array $columns = [],
    ) {
    }

    public function isPaginated(): bool
    {
        return $this->items instanceof LengthAwarePaginator;
    }

    /**
     * Normalize columns to: ['label' => string, 'key' => string|null, 'sortable' => bool]
     *
     * @return array<int, array{label: string, key: string|null, sortable: bool}>
     */
    public function normalizedColumns(): array
    {
        return array_map(function (string|array $col) {
            if (is_string($col)) {
                return ['label' => $col, 'key' => null, 'sortable' => false];
            }

            return [
                'label' => $col['label'],
                'key' => $col['key'] ?? null,
                'sortable' => $col['sortable'] ?? false,
            ];
        }, $this->columns);
    }

    public function currentSort(): string
    {
        return request()->query('sort', '');
    }

    public function currentDirection(): string
    {
        return request()->query('direction', 'asc') === 'desc' ? 'desc' : 'asc';
    }

    /**
     * Build sort URL toggling direction for the given column key.
     */
    public function sortUrl(string $key): string
    {
        $direction = ($this->currentSort() === $key && $this->currentDirection() === 'asc')
            ? 'desc'
            : 'asc';

        return request()->fullUrlWithQuery(['sort' => $key, 'direction' => $direction, 'page' => 1]);
    }

    public function sortIconClass(string $key): string
    {
        if ($this->currentSort() !== $key) {
            return 'icofont-sort opacity-30';
        }

        return $this->currentDirection() === 'asc'
            ? 'icofont-arrow-up text-primary'
            : 'icofont-arrow-down text-primary';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.table.index');
    }
}

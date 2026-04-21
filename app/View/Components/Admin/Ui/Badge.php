<?php

namespace App\View\Components\Admin\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $color = 'primary',
        public string $size = 'md',
        public bool $outline = false,
    ) {
    }

    public function classes(): string
    {
        $colors = [
            'primary' => 'badge-primary',
            'secondary' => 'badge-secondary',
            'accent' => 'badge-accent',
            'success' => 'badge-success',
            'warning' => 'badge-warning',
            'error' => 'badge-error',
            'info' => 'badge-info',
            'ghost' => 'badge-ghost',
        ];

        $sizes = [
            'xs' => 'badge-xs',
            'sm' => 'badge-sm',
            'md' => '',
            'lg' => 'badge-lg',
        ];

        return collect(['badge', $colors[$this->color] ?? 'badge-primary', $sizes[$this->size] ?? ''])
            ->when($this->outline, fn ($c) => $c->push('badge-outline'))
            ->filter()
            ->implode(' ');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.ui.badge');
    }
}

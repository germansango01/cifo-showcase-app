<?php

namespace App\View\Components\Admin\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $variant = 'primary',
        public string $size = 'md',
        public ?string $icon = null,
        public ?string $iconRight = null,
        public string $type = 'button',
        public bool $outline = false,
        public bool $ghost = false,
        public bool $loading = false,
        public bool $block = false,
        public ?string $href = null,
    ) {
    }

    public function classes(): string
    {
        $variants = [
            'primary' => 'btn-primary', 'secondary' => 'btn-secondary',
            'accent' => 'btn-accent', 'success' => 'btn-success',
            'warning' => 'btn-warning', 'error' => 'btn-error', 'info' => 'btn-info',
            'neutral' => 'btn-neutral',
        ];
        $sizes = ['xs' => 'btn-xs', 'sm' => 'btn-sm', 'md' => '', 'lg' => 'btn-lg'];

        return collect(['btn', $variants[$this->variant] ?? 'btn-primary', $sizes[$this->size] ?? ''])
            ->when($this->outline, fn ($c) => $c->push('btn-outline'))
            ->when($this->ghost, fn ($c) => $c->push('btn-ghost'))
            ->when($this->block, fn ($c) => $c->push('btn-block'))
            ->filter()->implode(' ');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.ui.button');
    }
}

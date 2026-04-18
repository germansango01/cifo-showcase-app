<?php

namespace App\View\Components\Admin\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Avatar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $src = null,
        public string $size = 'md',   // xs | sm | md | lg
        public bool $ring = false,
    ) {}
 
    public function initials(): string
    {
        $parts = array_filter(explode(' ', trim($this->name)));
        $first = mb_strtoupper(mb_substr($parts[0] ?? '?', 0, 1));
        $last  = isset($parts[1]) ? mb_strtoupper(mb_substr($parts[1], 0, 1)) : '';
 
        return $first . $last;
    }
 
    public function sizeClass(): string
    {
        return match ($this->size) {
            'xs'    => 'w-6',
            'sm'    => 'w-8',
            'lg'    => 'w-16',
            default => 'w-10',
        };
    }
 
    public function textSizeClass(): string
    {
        return match ($this->size) {
            'xs'    => 'text-xs',
            'sm'    => 'text-xs',
            'lg'    => 'text-xl',
            default => 'text-sm',
        };
    }
 
    /** Deterministic hue from name → DaisyUI semantic color */
    public function bgColorClass(): string
    {
        $colors = [
            'bg-primary',
            'bg-secondary',
            'bg-accent',
            'bg-info',
            'bg-success',
            'bg-warning',
        ];
 
        $hash = array_sum(array_map('ord', str_split($this->name)));
 
        return $colors[$hash % count($colors)];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.ui.avatar');
    }
}

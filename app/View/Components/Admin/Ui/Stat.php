<?php

namespace App\View\Components\Admin\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Stat extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public string $value,
        public ?string $icon = null,
        public ?string $trend = null,   // 'positive' | 'negative' | null
        public ?string $trendValue = null,
        public string $color = 'primary',
    ) {}
 
    public function trendClass(): string
    {
        return match ($this->trend) {
            'positive' => 'text-success',
            'negative' => 'text-error',
            default    => 'text-base-content/60',
        };
    }
 
    public function trendIcon(): string
    {
        return match ($this->trend) {
            'positive' => 'icofont-arrow-up',
            'negative' => 'icofont-arrow-down',
            default    => 'icofont-minus',
        };
    }
 
    public function colorClass(): string
    {
        return match ($this->color) {
            'secondary' => 'text-secondary',
            'accent'    => 'text-accent',
            'success'   => 'text-success',
            'warning'   => 'text-warning',
            'error'     => 'text-error',
            'info'      => 'text-info',
            default     => 'text-primary',
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.ui.stat');
    }
}

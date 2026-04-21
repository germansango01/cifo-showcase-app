<?php

namespace App\View\Components\Admin\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public string $type = 'text',
        public ?string $placeholder = null,
        public ?string $value = null,
        public ?string $help = null,
        public ?string $icon = null,
        public bool $required = false,
        public bool $disabled = false,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.ui.input');
    }
}

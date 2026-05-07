<?php

namespace App\View\Components\Admin\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TranslatableInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public string $type = 'text',
        public ?string $placeholder = null,
        public mixed $valueEs = null,
        public mixed $valueCa = null,
        public ?string $help = null,
        public ?string $icon = null,
        public bool $required = false,
        public bool $disabled = false,
        public ?string $formVar = null,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.ui.translatable-input');
    }
}

<?php

namespace App\View\Components\Admin\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public array $options = [],
        public mixed $selected = null,
        public ?string $placeholder = null,
        public bool $required = false,
        public bool $disabled = false,
        public ?string $icon = null,
        public ?string $help = null,
    ) { }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.ui.select');
    }
}

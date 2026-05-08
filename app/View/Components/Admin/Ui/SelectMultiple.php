<?php

namespace App\View\Components\Admin\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectMultiple extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  array<int|string, string>  $options  Associative map value => label.
     * @param  array<int, int|string>     $selected Pre-selected values (server side default).
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public array $options = [],
        public array $selected = [],
        public ?string $placeholder = null,
        public bool $required = false,
        public bool $disabled = false,
        public ?string $icon = null,
        public ?string $help = null,
        public ?string $searchPlaceholder = null,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.ui.select-multiple');
    }
}

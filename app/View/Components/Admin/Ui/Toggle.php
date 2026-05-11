<?php

namespace App\View\Components\Admin\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toggle extends Component
{
    public function __construct(
        public string $name,
        public ?string $label = null,
        public bool $checked = false,
        public mixed $value = 1,
        public bool $disabled = false,
        public ?string $help = null,
        public bool $inline = false,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.ui.toggle');
    }
}

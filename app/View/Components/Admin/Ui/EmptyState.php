<?php

namespace App\View\Components\Admin\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyState extends Component
{
    public function __construct(
        public string $icon,
        public string $title,
        public string $message,
        public ?string $actionLabel = null,
        public ?string $actionHref = null,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.ui.empty-state');
    }
}

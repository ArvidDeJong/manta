<?php

namespace Darvis\Manta\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Darvis\Manta\Models\Page;

class GetPage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $attribute = 'title',
        public bool $edit = false,
        public ?int $id = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $page = Page::find($this->id);
        return view('manta::components.website.get-page', compact('page'));
    }
}

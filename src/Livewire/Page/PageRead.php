<?php

namespace Darvis\Manta\Livewire\Page;

use Livewire\Component;
use Darvis\Manta\Models\Page;
use Darvis\Manta\Traits\MantaTrait;
use Illuminate\Http\Request;

class PageRead extends Component
{
    use MantaTrait;
    use PageTrait;

    public function mount(Request $request, Page $page)
    {
        $this->item = $page;
        $this->itemOrg = $page;
        $this->locale = $page->locale;
        if ($request->input('locale') && $request->input('locale') != getLocaleManta()) {
            $this->pid = $page->id;
            $this->locale = $request->input('locale');
            $item_translate = Page::where(['pid' => $page->id, 'locale' => $request->input('locale')])->first();
            $this->item = $item_translate;
        }

        if ($page) {
            $this->id = $page->id;
        }

        $this->getLocaleInfo();
        $this->tablistShow = $this->locale;
        $this->getTablist();
        $this->getBreadcrumb('read');
    }

    public function render()
    {
        return view('manta::default.manta-default-read')->title($this->config['module_name']['single'] . ' bekijken');
    }
}

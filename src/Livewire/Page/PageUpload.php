<?php

namespace Darvis\Manta\Livewire\Page;

use Livewire\Component;
use Darvis\Manta\Models\Page;
use Darvis\Manta\Traits\MantaTrait;

class PageUpload extends Component
{
    use MantaTrait;
    use PageTrait;

    public function mount(Page $page)
    {
        $this->item = $page;
        $this->itemOrg = $page;
        $this->id = $page->id;
        $this->locale = $page->locale;

        $this->getLocaleInfo();
        $this->getTablist();
        $this->getBreadcrumb('upload');
    }

    public function render()
    {
        return view('manta::default.manta-default-upload')->title($this->config['module_name']['single'] . ' bestanden');
    }
}

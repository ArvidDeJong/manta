<?php

namespace Darvis\Manta\Livewire\Cms;

use Livewire\Component;

class CmsSandbox extends Component
{

    public array $breadcrumb = [];

    public $data;

    public function mount()
    {

        $this->getBreadcrumb();
    }

    public function render()
    {
        $result = [];

        return view('manta::livewire.cms.cms-sandbox', compact('result'))->title('Zandbak');
    }

    public function getBreadcrumb()
    {
        $this->breadcrumb = [
            ["title" => 'Dashboard', "url" => route('cms.dashboard')],
            ["title" => "Zandbak",],
        ];
    }
}

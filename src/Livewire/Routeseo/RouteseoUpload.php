<?php

namespace Darvis\Manta\Livewire\Routeseo;

use Livewire\Component;
use Darvis\Manta\Models\Routeseo;
use Darvis\Manta\Traits\MantaTrait;

class RouteseoUpload extends Component
{
    use MantaTrait;
    use RouteseoTrait;

    public function mount(Routeseo $routeseo)
    {
        $this->item = $routeseo;
        $this->itemOrg = $routeseo;
        $this->id = $routeseo->id;
        $this->locale = $routeseo->locale;

        $this->getLocaleInfo();
        $this->getTablist();
        $this->getBreadcrumb('upload');
    }

    public function render()
    {
        return view('manta::default.manta-default-upload')->title($this->config['module_name']['single'] . ' bestanden');
    }
}

<?php

namespace Darvis\Manta\Livewire\Cms;

use Livewire\Component;

class CmsDashboard extends Component
{
    public function render()
    {
        return view('manta::livewire.cms.cms-dashboard')->title('Dashboard');
    }
}

<?php

namespace Darvis\Manta\Livewire\Cms;

use Livewire\Component;

class CmsDashboard extends Component
{
    public function render()
    {
        return view('livewire.manta.cms.cms-dashboard')->title('Dashboard');
    }
}

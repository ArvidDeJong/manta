<?php

namespace Darvis\Manta\Livewire\Routeseo;

use Flux\Flux;
use Livewire\Component;
use Darvis\Manta\Models\Routeseo;
use Darvis\Manta\Traits\MantaTrait;
use Illuminate\Http\Request;

class RouteseoUpdate extends Component
{
    use MantaTrait;
    use RouteseoTrait;

    public function mount(Request $request, Routeseo $routeseo)
    {
        $this->item = $routeseo;
        $this->itemOrg = translate($routeseo, 'nl')['org'];
        $this->id = $routeseo->id;
        $this->locale = $routeseo->locale;

        $this->fill(
            $routeseo->only(
                'pid',
                'locale',
                'title',
                'route',
                'seo_title',
                'seo_description',
            ),
        );

        $this->getLocaleInfo();
        $this->getTablist();
        $this->getBreadcrumb('update');
    }

    public function render()
    {
        return view('livewire.manta.default.manta-default-update')->title($this->config['module_name']['single'] . ' aanpassen');
    }


    public function save()
    {
        $this->validate();

        $row = $this->only(
            'title',
            'route',
            'seo_title',
            'seo_description',
        );
        $row['updated_by'] = auth('staff')->user()->name;
        Routeseo::where('id', $this->id)->update($row);

        // return redirect()->to(route($this->route_name . '.list'));
        Flux::toast('Opgeslagen', duration: 1000, variant: 'success');
    }
}

<?php

namespace Darvis\Manta\Livewire\Routeseo;

use Livewire\Component;
use Darvis\Manta\Models\Routeseo;
use Darvis\Manta\Traits\MantaTrait;
use Illuminate\Http\Request;

class RouteseoCreate extends Component
{
    use MantaTrait;
    use RouteseoTrait;

    public function mount(Request $request)
    {
        $this->locale = getLocaleManta();
        if ($request->input('locale') && $request->input('pid')) {
            $item = Routeseo::find($request->input('pid'));
            $this->pid = $item->id;
            $this->locale = $request->input('locale');
            $this->itemOrg = $item;
        }

        $this->getLocaleInfo();
        $this->getTablist();
        $this->getBreadcrumb('create');
    }

    public function render()
    {
        return view('livewire.manta.default.manta-default-create')->title($this->config['module_name']['single'] . ' toevoegen');
    }

    public function save()
    {
        $this->validate();

        $row = $this->only(
            'pid',
            'locale',
            'title',
            'route',
            'seo_title',
            'seo_description',
        );
        $row['created_by'] = auth('staff')->user()->name;
        Routeseo::create($row);
        // $this->toastr('success', 'SEO route toegevoegd');

        return $this->redirect(RouteseoList::class);
    }
}

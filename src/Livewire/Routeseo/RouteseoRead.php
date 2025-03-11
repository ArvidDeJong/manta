<?php

namespace Darvis\Manta\Livewire\Routeseo;

use Livewire\Component;
use Darvis\Manta\Models\Routeseo;
use Darvis\Manta\Traits\MantaTrait;
use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Http\Request;

class RouteseoRead extends Component
{
    use MantaTrait;
    use RouteseoTrait;

    public function mount(Request $request, Routeseo $routeseo)
    {
        $this->item = $routeseo;
        $this->itemOrg = $routeseo;
        $this->locale = $routeseo->locale;
        if ($request->input('locale') && $request->input('locale') != getLocaleManta()) {
            $this->pid = $routeseo->id;
            $this->locale = $request->input('locale');
            $item_translate = Routeseo::where(['pid' => $routeseo->id, 'locale' => $request->input('locale')])->first();
            $this->item = $item_translate;
        }

        if ($routeseo) {
            $this->id = $routeseo->id;
        }
        $this->getLocaleInfo();
        $this->getTablist();
        $this->getBreadcrumb('read');
    }

    public function render()
    {
        return view('manta::default.manta-default-read')->title($this->config['module_name']['single'] . ' bekijken');
    }



    public function translate()
    {
        $translate = new TranslateClient([
            'key' => env('GOOGLE_KEY_PHP')
        ]);

        $result = $translate->translate((string)$this->itemOrg->seo_title, [
            'source' => getLocaleManta(),
            'target' => $this->locale
        ]);
        $seo_title = $result['text'];

        $result = $translate->translate((string)$this->itemOrg->seo_description, [
            'source' => getLocaleManta(),
            'target' => $this->locale
        ]);
        $seo_description = $result['text'];

        $row = [
            'pid' => $this->itemOrg->id,
            'locale' => $this->locale,
            'title' => $this->itemOrg->title,
            'route' => $this->itemOrg->route,
            'seo_title' => $seo_title,
            'seo_description' => $seo_description,
        ];
        $row['created_by'] = auth('staff')->user()->name;
        Routeseo::create($row);

        return redirect()->to(route('item.read', ['item' => $this->itemOrg, 'locale' => $this->locale]));
    }
}

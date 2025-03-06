<?php

namespace Darvis\Manta\Livewire\Routeseo;

use Livewire\Component;
use Darvis\Manta\Models\Routeseo;
use Darvis\Manta\Services\Openai;
use Darvis\Manta\Traits\SortableTrait;
use Darvis\Manta\Traits\MantaTrait;
use Darvis\Manta\Traits\WithSortingTrait;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Route;
use Google\Cloud\Translate\V2\TranslateClient;

class RouteseoList extends Component
{
    use WithPagination;
    use SortableTrait;
    use MantaTrait;
    use WithSortingTrait;
    use RouteseoTrait;

    public function mount()
    {
        try {
            $translate = new TranslateClient([
                'key' => env('GOOGLE_KEY_PHP'),
                'suppressKeyFileNotFoundWarning' => true,
                'keyFilePath' => null
            ]);

            $router = Route::getRoutes();
            foreach ($router as $value) {
                if (str_contains($value->getName(), 'compri_routes.')) {
                    $check = RouteSeo::where([
                        'locale' => getLocaleManta(),
                        'route' => $value->getName()
                    ])->first();
                    if (!$check) {
                        $title = str_replace('compri_routes.', '', $value->getName());
                        $result = $translate->translate((string)str_replace('compri_routes.', '', $title), [
                            'source' => 'en',
                            'target' => getLocaleManta()
                        ]);
                        $answer = $result['text'];
                        RouteSeo::Create([
                            'created_by' => 'system',
                            'pid' => null,
                            'locale' => getLocaleManta(),
                            'route' => $value->getName(),
                            'seo_title' => ucfirst($answer),
                            'title' => ucfirst($answer),
                        ]);
                    }
                }
            }
            $this->getBreadcrumb();
        } catch (\Exception $e) {
            // Handle the exception
        }
    }

    public function render()
    {
        $obj = Routeseo::whereNull('pid');
        if ($this->tablistShow == 'trashed') {
            $obj->onlyTrashed();
        }
        $obj = $this->applySorting($obj);
        $obj = $this->applySearch($obj);
        $items = $obj->paginate(50);
        return view('livewire.manta.routeseo.routeseo-list', ['items' => $items])->title('SEO routes');
    }

    public function createSeoTitle($id)
    {
        $item = Routeseo::find($id);
        $openai = new Openai();
        $openai->question = !empty($item->title) ? $item->title : env('APP_NAME');
        $openai->destinationLanguage = 'nl';
        $item->seo_title = preg_replace('/"/i', '', $openai->getSeoTitle()['answer']);
        $item->save();
    }

    public function createSeoDescription($id)
    {
        $item = Routeseo::find($id);
        $openai = new Openai();
        $openai->question = !empty($item->title) ? $item->title : env('APP_NAME');
        $openai->destinationLanguage = 'nl';
        $item->seo_description = preg_replace('/"/i', '', $openai->getSeoDescription()['answer']);
        $item->save();
    }

    public function translateEmptyFields()
    {

        try {
            $translate = new TranslateClient([
                'key' => env('GOOGLE_KEY_PHP'),
                'suppressKeyFileNotFoundWarning' => true,
                'keyFilePath' => null
            ]);

            $list = Routeseo::whereNull('pid')->get();
            foreach ($list as $row) {
                if (count(collect(getLocalesManta())->where('active', true)->all()) > 1) {
                    foreach (getLocalesManta() as $value) {
                        if ($value['active'] && $value['locale'] != getLocaleManta()) {
                            $find = Routeseo::where(['pid' => $row->id, 'locale' => $value['locale']])->first();
                            if (!$find) {
                                $result = $translate->translate((string)$row->title, [
                                    'source' => getLocaleManta(),
                                    'target' => $value['locale']
                                ]);
                                $title = $result['text'];

                                $result = $translate->translate((string)$row->seo_title, [
                                    'source' => getLocaleManta(),
                                    'target' => $value['locale']
                                ]);
                                $seo_title = $result['text'];

                                $result = $translate->translate((string)$row->seo_description, [
                                    'source' => getLocaleManta(),
                                    'target' => $value['locale']
                                ]);
                                $seo_description = $result['text'];

                                RouteSeo::Create([
                                    'created_by' => 'system',
                                    'pid' => $row->id,
                                    'locale' => $value['locale'],
                                    'route' => $row->route,
                                    'seo_title' => ucfirst($seo_title),
                                    'seo_description' => ucfirst($seo_description),
                                    'title' => ucfirst($title),
                                ]);
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Handle the exception
        }
    }
}

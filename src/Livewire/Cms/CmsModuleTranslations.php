<?php

namespace Darvis\Manta\Livewire\Cms;

use Livewire\Component;

class CmsModuleTranslations extends Component
{
    public array $breadcrumb = [];

    public array $items = [];
    public $total = 0;

    public function mount()
    {
        $this->getBreadcrumb();

        $modules = collect(cms_config('manta')['modules']);

        $arr = [];
        $total = 0;
        foreach ($modules as $key => $module) {
            if (!isset(module_config(Ucfirst($module['name']))['fields']['locale']['active'])) {
                $arr[$module['title']] = ['to_translate' => 0, 'total' => 0];
                continue;
            }
            if (module_config(Ucfirst($module['name']))['fields']['locale']['active']) {

                if ($module['name'] != 'upload') {
                    $total++;
                    $arr[$module['title']] = ['to_translate' => 0, 'total' => 0];

                    $moduleName = Ucfirst($module['name']);

                    // Skip de loop als de modulenaam "Mailtrap" is
                    if ($moduleName === "Mailtrap") {
                        continue;
                    }

                    // Probeer eerst de Darvis\Manta\Models namespace
                    $className = 'Darvis\Manta\Models\\' . $moduleName;

                    // Controleer of de klasse bestaat, zo niet, probeer de alternatieve namespace
                    if (!class_exists($className)) {
                        $className = 'Manta\Models\\' . $moduleName;

                        // Als de klasse nog steeds niet bestaat, ga door naar de volgende module
                        if (!class_exists($className)) {
                            continue;
                        }
                    }

                    $items = $className::where('locale', getLocaleManta())->get();
                    // $arr[$module['title']]['to_translate'] = 0;
                    // $arr[$module['title']]['total'] = 0;
                    foreach ($items as $key2 => $item) {
                        $arr[$module['title']]['rows'][$key2]['title'] = $item->title ? $item->title : $item->created_at;
                        foreach (getLocalesManta() as $locale) {
                            if ($locale['locale'] != getLocaleManta()) {
                                $total++;
                                $arr[$module['title']]['total'] = $arr[$module['title']]['total']  + 1;
                                $translation = $className
                                    ::where(['locale' => $locale['locale'], 'pid' => $item->id])
                                    ->first();

                                if ($translation) {
                                    $arr[$module['title']]['rows'][$key2][$locale['locale']] = ['route' => route($module['name'] . '.update', [$module['name'] => $translation]), 'variant' => 'update'];
                                } else {
                                    $arr[$module['title']]['rows'][$key2][$locale['locale']] = ['route' => route($module['name'] . '.create', ['pid' => $item->id, 'locale' => $locale['locale']]), 'variant' => 'create'];
                                    $arr[$module['title']]['to_translate'] = $arr[$module['title']]['to_translate']  + 1;
                                }
                            }
                        }
                    }
                }
            }
        }
        $this->total =   $total;
        $this->items =  $arr;
    }

    public function render()
    {
        return view('manta::livewire.cms.cms-module-translations')->title('Vertalingen overzicht');
    }

    public function getBreadcrumb()
    {
        $this->breadcrumb = [
            ["title" => 'Dashboard', "url" => route('cms.dashboard')],
            ["title" => "Module vertalingen overzicht",],
        ];
    }
}

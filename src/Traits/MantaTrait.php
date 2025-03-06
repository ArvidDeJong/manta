<?php

namespace Darvis\Manta\Traits;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Darvis\Manta\Models\Option;
use Flux\Flux;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Locked;

trait MantaTrait
{
    #[Locked]
    public $id;

    public ?string $slug = null;
    public string $show = 'active';
    public ?string $search = '';
    public array $breadcrumb = [];

    public ?string $tablistShow = 'general';
    public array $tablist = [];

    public ?string $tablistModuleShow = 'general';
    public array $tablistModule = [];

    public ?string $route_list = null;

    public ?string $tab_title = null;
    public ?int $trashed = null;
    public ?string $deleteId = null;
    public ?string $moduleClass = null;
    public array $locale_info = [];
    public array $config = [];
    public string $breadcumbHomeName = 'Dashboard';
    public array $fields = [];
    public array $settings = [];

    public array $data = [];
    public string $data_locale = 'nl';
    public array $data_content = [];
    public array $data_fields = [];

    public ?string $openaiSubject = null;
    public ?string $openaiDescription = null;

    public function getLocaleInfo()
    {
        $this->locale = $this->locale ?? getLocaleManta();

        $this->locale_info = collect(getLocalesManta())
            ->firstWhere('locale', $this->locale)
            ?? collect(getLocalesManta())
            ->firstWhere('locale', getLocaleManta());

        $this->locale = $this->locale_info['locale'];
    }

    public function getBreadcrumb($type = null, $options = [])
    {
        $titles = [
            'create' => 'Toevoegen',
            'read' => 'Bekijken',
            'update' => 'Aanpassen',
            'upload' => 'Bestanden',
            'maps' => 'Google maps',
            'tree' => 'Boomstructuur',
            'settings' => 'Instellingen',
        ];
        $tab_title = $this->tab_title;

        $breadcrumb = [];
        $breadcrumb[] =
            [
                "title" => $this->breadcumbHomeName,
                "url" => route('cms.dashboard')
            ];

        if (isset($options['parents']) && count($options['parents']) > 0) {
            foreach ($options['parents'] as $value) {
                $breadcrumb[] =  [
                    "title" => $value['title'],
                    "url" => $value['url'],
                ];
            }
        }

        if (!isset($options['no_list'])) {
            $breadcrumb[] =  [
                "title" => $this->config['module_name']['multiple'],
                "url" => in_array($type, array_keys($titles))
                    ? route($this->route_name . '.list')
                    : $type
            ];
        }

        if (!$this->item && $this->itemOrg) {
            $breadcrumb[] = [
                "title" => $this->tab_title ? $this->itemOrg->$tab_title : $this->itemOrg->title,
                'url' => route($this->route_name . '.read', [$this->route_name => $this->itemOrg])
            ];
        }

        if (isset($titles[$type])) {
            $breadcrumb[] = [
                "title" => $titles[$type],
                "flag" => isset($this->locale_info['class']) && count(getLocalesManta()) > 1
                    ? $this->locale_info['class']
                    : null
            ];
        }

        $this->breadcrumb = $breadcrumb;
    }

    public function getTablist()
    {
        $tablist = [];

        $locales = getLocalesManta();
        $tab_title = $this->tab_title;

        if (!$this->itemOrg) {
            $tablist[] = [
                'name' => 'Toevoegen',
                'title' => 'Toevoegen',
                'tablistShow' => 'Toevoegen',
                'url' => 'javascript:;',
                'active' => true,
            ];
            $this->tablistModuleShow = 'Toevoegen';
        } else if ($this->itemOrg && count($locales) > 1 && isset($this->fields['locale']['active']) && $this->fields['locale']['active'] == true) {
            foreach ($locales as $value) {
                $active = Route::currentRouteName() == $this->route_name . '.upload'
                    ? false
                    : ($this->locale == $value['locale']);

                $tablist[] = [
                    'name' => $value['locale'],
                    'title' => $value['title'],
                    'tablistShow' => $value['locale'],
                    'url' => route($this->route_name . '.read', [$this->route_name => $this->itemOrg, 'locale' => $value['locale']]),
                    'active' => $active,
                ];
                if ($active) {
                    $this->tablistModuleShow = $value['locale'];
                }
            }
        } elseif ($this->itemOrg) {
            $tablist[] = [
                'name' => $this->tab_title ? $this->itemOrg->$tab_title : $this->itemOrg->title,
                'title' => $this->tab_title ? $this->itemOrg->$tab_title : $this->itemOrg->title,
                'tablistShow' => $this->tab_title ? $this->itemOrg->$tab_title : $this->itemOrg->title,
                'url' => route($this->route_name . '.read', [$this->route_name => $this->itemOrg]),
                'active' => in_array(Route::currentRouteName(), [$this->route_name . '.update', $this->route_name . '.read']),
            ];
            if (in_array(Route::currentRouteName(), [$this->route_name . '.update', $this->route_name . '.read'])) {
                $this->tablistModuleShow = $this->tab_title ? $this->itemOrg->$tab_title : $this->itemOrg->title;
            }
        }
        if ($this->itemOrg && isset($this->fields['uploads']) && $this->fields['uploads']['active'] == true) {
            $tablist[] = [
                'name' => 'Uploads',
                'title' => 'Uploads',
                'badge' =>  count($this->itemOrg->uploads),
                'tablistShow' => 'Uploads',
                'url' => route($this->route_name . '.upload', [$this->route_name => $this->itemOrg]),
                'active' => (Route::currentRouteName() == $this->route_name . '.upload'),
            ];
            if ((Route::currentRouteName() == $this->route_name . '.upload')) {
                $this->tablistModuleShow = 'Uploads';
            }
        }
        if ($this->itemOrg && isset($this->fields['maps']) && $this->fields['maps']['active'] == true) {
            $tablist[] = [
                'name' => 'Maps',
                'title' => 'Google maps',
                'tablistShow' => 'Maps',
                'url' => route($this->route_name . '.maps', [$this->route_name => $this->itemOrg]),
                'active' => (Route::currentRouteName() == $this->route_name . '.maps'),
            ];
            if ((Route::currentRouteName() == $this->route_name . '.maps')) {
                $this->tablistModuleShow = 'Maps';
            }
        }

        $this->tablistModule = array_merge($tablist,   $this->tablistModule);
    }

    public function getTablistSettings()
    {
        $locales = getLocalesManta();
        foreach ($locales as $value) {
            $active = Route::currentRouteName() == $this->route_name . '.upload'
                ? false
                : ($this->locale == $value['locale']);

            $tablist[] = [
                'name' => $value['locale'],
                'title' => $value['title'],
                'tablistShow' => $value['locale'],
                'url' => route($this->route_name . '.settings', [$this->route_name => $this->itemOrg, 'locale' => $value['locale']]),
                'active' => $active,
            ];
            if ($active) {
                $this->tablistModuleShow = $value['locale'];
            }
        }

        $this->tablistModule = array_merge($tablist,   $this->tablistModule);
    }

    public function updatedTitle()
    {
        if (! $this->slug) {
            $this->slug = Str::of($this->title)->slug('-');
            $this->seo_title = $this->title;
        }
    }

    public function updatedSlug()
    {
        $this->slug = Str::of($this->slug)->slug('-');
    }

    public function deleteConfirm($id)
    {
        Flux::modal('member-remove')->close();

        $this->moduleClass::where('id', $id)->update(['deleted_by' => auth('staff')->user()->name]);
        $this->moduleClass::find($id)->delete();
    }

    public function restoreConfirm($id)
    {
        Flux::modal('member-restore')->close();

        $this->moduleClass::withTrashed()->where('id', $id)->restore();
        $this->trashed = count($this->moduleClass::onlyTrashed()->get());
        $this->tablistModuleShow = 'general';
    }

    public function updateRowOrder($orderedIds)
    {
        foreach ($orderedIds as $index => $id) {
            $this->moduleClass::where('id', $id)->update(['sort' => $index + 1]);
        }
    }

    public function getSettings()
    {

        $settingsArr = [];
        foreach ($this->config['settings'] as $key => $value) {

            $item = Option::get($key, $this->moduleClass, $this->locale);

            if ($item == null) {
                Option::set($key, isset($value['default']) ? $value['default'] : "", $this->moduleClass, $this->locale);
            }
            $item = Option::get($key, $this->moduleClass, $this->locale);
            $settingsArr[$key] = $item;
        }
        $this->settingsArr = $settingsArr;

        $config = collect($this->config);
        $emailcodes = [];
        if (isset($this->config['ereg']['tables']) && count($this->config['ereg']['tables']) > 0) {
            foreach ($this->config['ereg']['tables'] as $table => $values) {
                $columns = Schema::getColumnListing($table);
                foreach ($columns as $column) {
                    if (in_array($column, $values['select']) && isset($config->get('fields')[$column]) && $config->get('fields')[$column]['active'] == true) {
                        $emailcodes[] = ['title' => $config->get('fields')[$column]['title'], 'value' => '{{ $' . $values['variable'] . '->' . $column . ' }}'];
                    }
                }
            }
        }
        usort($emailcodes, function ($a, $b) {
            return strcmp($a['title'], $b['title']);
        });
        $this->emailcodes = $emailcodes;
    }

    public function putSettings()
    {
        foreach ($this->config['settings'] as $key => $value) {

            Option::set($key,     $this->settingsArr[$key], $this->moduleClass, $this->locale);
        }

        Flux::toast('Opgeslagen', duration: 1000, variant: 'success');
    }

    public function translate()
    {
        if (file_exists(base_path('auth-google-translate.json'))) {
            if (env('SUPPORTED_LOCALES')) {
                $APP_LOCALE =  env('APP_LOCALE');
                $locales = explode(',', env('SUPPORTED_LOCALES'));
                $class =  class_basename($this->moduleClass);
                foreach ($locales as $locale) {
                    if ($locale != $APP_LOCALE) {
                        Artisan::call("records:translate {$class} {$locale} {$APP_LOCALE}");
                    }
                }
            };
            Flux::toast('Vertalingen toegepast', duration: 1000, variant: 'success');
        } else {
            Flux::toast('Geen vertaal abonnement', duration: 1000, variant: 'danger');
        }
    }
}

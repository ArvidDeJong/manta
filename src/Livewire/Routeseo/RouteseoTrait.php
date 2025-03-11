<?php

namespace Darvis\Manta\Livewire\Routeseo;

use Darvis\Manta\Models\Routeseo;
use Darvis\Manta\Services\Openai;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Illuminate\Support\Str;
use Livewire\Attributes\Js;

trait RouteseoTrait
{
    public function __construct()
    {
        $this->route_name = 'routeseo';
        $this->route_list = route($this->route_name . '.list');
        $this->config = manta_config('Routeseo');
        $this->fields = $this->config['fields'];
        $this->moduleClass = 'Darvis\Manta\Models\Routeseo';
        $this->tab_title = isset($this->config['tab_title']) ? $this->config['tab_title'] : null;
    }

    public ?Routeseo $item = null;
    public ?Routeseo $itemOrg = null;

    public ?string $pid = null;
    public ?string $locale = null;
    public ?string $title = null;
    public ?string $route = null;
    public ?string $seo_title = null;
    public ?string $seo_description = null;



    protected function applySearch($query)
    {
        return $this->search === ''
            ? $query
            : $query->where(function (Builder $querysub) {
                $querysub->where('seo_title', 'LIKE', "%{$this->search}%")
                    ->orWhere('seo_description', 'LIKE', "%{$this->search}%")
                    ->orWhere('title', 'LIKE', "%{$this->search}%");
            });
    }

    public function rules()
    {
        $return = [];

        if ($this->fields['locale']['active'] == true && $this->fields['locale']['required'] == true) {
            $return['locale'] = 'nullable|string|max:255';
        }

        if ($this->fields['title']['active'] == true && $this->fields['title']['required'] == true) {
            $return['title'] = 'nullable|string|max:255';
        }

        if ($this->fields['route']['active'] == true && $this->fields['route']['required'] == true) {
            $return['route'] = 'nullable|string|max:255';
        }

        if ($this->fields['seo_title']['active'] == true && $this->fields['seo_title']['required'] == true) {
            $return['seo_title'] = 'nullable|string|max:255';
        }

        if ($this->fields['seo_description']['active'] == true && $this->fields['seo_description']['required'] == true) {
            $return['seo_description'] = 'nullable|string|max:255';
        }

        return $return;
    }

    public function messages()
    {
        return [
            'locale.required' => 'De taal is verplicht',
            'title.required' => 'De titel is verplicht',
            'route.required' => 'De route is verplicht',
            'seo_title.required' => 'De SEO-titel is verplicht',
            'seo_description.required' => 'De SEO-beschrijving is verplicht',
        ];
    }
}

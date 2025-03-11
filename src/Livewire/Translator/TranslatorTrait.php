<?php

namespace Darvis\Manta\Livewire\Translator;


trait TranslatorTrait
{
    public function __construct()
    {
        $this->route_name = 'translator';
        $this->route_list = route($this->route_name . '.list');
        $this->config = manta_config('Translator');
        $this->fields = $this->config['fields'];
        // $this->settings = $this->config['settings'];
        $this->moduleClass = 'Darvis\Manta\Models\Translator';
        $this->tab_title = isset($this->config['tab_title']) ? $this->config['tab_title'] : null;
    }

    public ?object $item = null;
    public ?object $itemOrg = null;
}

<?php

namespace Darvis\Manta\Livewire\Option;


trait OptionTrait
{
    public function __construct()
    {
        $this->route_name = 'option';
        // $this->route_list = route($this->route_name . '.list');
        $this->config = module_config('Option');
        $this->fields = $this->config['fields'];
        $this->moduleClass = 'Darvis\Manta\Models\Option';
        $this->tab_title = isset($this->config['tab_title']) ? $this->config['tab_title'] : null;
    }
}

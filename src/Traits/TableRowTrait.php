<?php

namespace Darvis\Manta\Traits;

trait TableRowTrait
{
    public array $fields;
    public string $route_name;
    public string $moduleClass;

    public function remove()
    {
        $this->modal('member-remove')->show();
    }

    public function restore()
    {
        $this->modal('member-restore')->show();
    }
}

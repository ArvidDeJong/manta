<?php

namespace Darvis\Manta\Traits;

trait MantaPagerowTrait
{

    public ?string $route_name = null;
    public array $fields = [];
    public ?int $tablekey = null;
    public $deleteId;
    public $moduleClass;

    public function remove()
    {
        $this->modal('member-remove')->show();
    }

    public function restore()
    {
        $this->modal('member-restore')->show();
    }
}

<?php

namespace Darvis\Manta\Livewire\Cms;

use Livewire\Component;
use Livewire\Attributes\Locked;

class CmsInlineEditor extends Component
{
    public string $style = '';

    public string $content = '';

    #[Locked]
    public ?string $class = null;

    #[Locked]
    public ?string $id = null;

    #[Locked]
    public ?string $attribute = null;

    #[Locked]
    public bool $edit_button = false;

    public bool $wysiwyg = true;

    public bool $editing = false;

    #[Locked]
    public ?string $route_edit = null;

    public function save()
    {

        if ($this->content != '[-- leeg --]') {
            $class = $this->class;
            $class::find($this->id)->update([$this->attribute => $this->content]);
        }

        $this->editing = false;
    }

    public function edit()
    {
        $this->editing = true;
    }

    public function mount()
    {
        $class = $this->class;
        $item = $class::find($this->id);

        if (!$item) {
            return abort(404);
        }

        $translate =  translate($item);
        $this->id = $translate['result']->id;

        $this->content = $translate['result']->{$this->attribute} && !empty($translate['result']->{$this->attribute}) ? $translate['result']->{$this->attribute} : '[-- leeg --]';
    }

    public function updatedContent()
    {
        $this->save();
    }

    public function render()
    {
        return view('manta::livewire.cms.cms-inline-editor');
    }
}

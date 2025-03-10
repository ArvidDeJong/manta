<?php

namespace Darvis\Manta\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Translator extends Component
{

    public ?string $string = null;
    public ?string $href = null;
    public bool $edit = true;
    public bool $showString = true;

    /**
     * Create a new component instance.
     */
    public function __construct($string, $edit = true, $showString = true)
    {
        if ($showString) {
            $this->string = __($string);
        } else {
            $this->string = 'Aanpassen';
        }

        if ($edit == true && auth('staff')->user()) {
            $exp = explode('.', $string);
            $this->string .= '&nbsp;<a href="' . env('APP_URL') . '/cms/talen/update?file=lang%2F' . app()->getLocale() . '%2F' . $exp[0] . '.php#' . $exp[1] . '"  style="text-decoration: none; font-size: 12px; background-color: #fff;" target="_blank"><i class="fa-solid fa-pen-to-square"></i></a>';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('manta::components.website.translator');
    }
}

<?php

namespace Darvis\Manta\Livewire\Translator;

use Flux\Flux;
use Illuminate\Http\Request;
use Livewire\Component;
use Darvis\Manta\Traits\MantaTrait;

class TranslatorUpdate extends Component
{
    use MantaTrait;
    use TranslatorTrait;

    public $location;
    public array $items = [];
    public $file;

    public function mount(Request $request)
    {
        // Bouw het volledige pad naar het bestand op binnen de resources directory
        $fileLocation = resource_path(ltrim($request->input('file'), '/'));
        $this->file = $request->input('file');
        // Controleer of het bestand bestaat en binnen het toegestane pad valt
        if (!file_exists($fileLocation)) {
            abort(403, 'Toegang tot dit bestand is verboden.');
        }

        $this->location = $fileLocation;
        // $this->breadcrumb_show = $request->input('breadcrumb_show') !== "false";

        if (pathinfo($this->location, PATHINFO_EXTENSION) == 'json') {
            $this->items = json_decode(file_get_contents($this->location), true);
        } elseif (pathinfo($this->location, PATHINFO_EXTENSION) == 'php') {
            $this->items = include($this->location);
        }

        // Sorteer de items op alfabetische volgorde van de sleutels
        ksort($this->items);

        $this->getBreadcrumb();
    }

    public function render()
    {
        return view('manta::livewire.translator.translator-update')->title('Vertaling aanpassen');
    }



    public function write()
    {
        if (pathinfo($this->location)['extension'] == 'json') {
            $jsonString = json_encode($this->items, JSON_PRETTY_PRINT);
            // Write in the file
            $fp = fopen($this->location, 'w');
            fwrite($fp, $jsonString);
            fclose($fp);
        } else {
            file_put_contents($this->location, '<?php' . PHP_EOL . PHP_EOL . ' return ' . var_export($this->items, true) . ';');
        }

        Flux::toast('Opgeslagen', duration: 1000, variant: 'success');
    }
}

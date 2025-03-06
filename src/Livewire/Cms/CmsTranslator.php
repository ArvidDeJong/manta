<?php

namespace Darvis\Manta\Livewire\Cms;

use Livewire\Component;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class CmsTranslator extends Component
{
    #[Locked]
    public ?string $string = null;

    #[Locked]
    public ?string $locale = null;

    public bool $showString = false;

    public ?string $style = null;

    public ?string $content = null;

    public bool $editing = false;

    public function mount()
    {
        $this->locale = app()->getLocale();
        if ($this->showString) {
            $this->content = $this->string;
        } else {
            $this->content = __($this->string, [], $this->locale);
        }
    }

    public function render()
    {
        return view('livewire.manta.cms.cms-translator');
    }

    public function save()
    {
        $langPath = lang_path($this->locale);
        $langFile = $langPath . '/compri.php';

        // Controleer of de directory bestaat, zo niet maak deze aan
        if (!File::exists($langPath)) {
            File::makeDirectory($langPath, 0755, true);
        }

        // Als het bestand niet bestaat, maak het aan
        if (!File::exists($langFile)) {
            File::put($langFile, "<?php\n\nreturn [\n];");
        }

        // Laad de huidige vertalingen
        $translations = require $langFile;

        // Update de vertaling direct in de root
        $key = explode('.', $this->string);
        $translations[$key[count($key) - 1]] = $this->content;

        // Sla het bestand op
        $content = "<?php\n\nreturn " . var_export($translations, true) . ";\n";
        File::put($langFile, $content);

        // Clear translation en view cache
        Artisan::call('cache:clear');
        Artisan::call('view:clear');

        $this->editing = false;
    }

    public function edit()
    {
        $this->editing = true;
    }
}

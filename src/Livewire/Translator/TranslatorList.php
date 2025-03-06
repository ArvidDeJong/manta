<?php

namespace Darvis\Manta\Livewire\Translator;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Support\Str;
use Darvis\Manta\Traits\MantaTrait;
use Symfony\Component\Translation\Command\TranslationTrait;

class TranslatorList extends Component
{
    use MantaTrait;
    use TranslatorTrait;

    public $file;
    public $directory;
    public $directory_add;
    public $files_in_directory;
    public $translate_files = [];
    public $directoryUrl;
    public $supported = [];

    public function mount()
    {
        $this->directory = resource_path() . '/lang/';
        $this->directoryUrl =  'lang/';

        $this->supported = explode(',', env('SUPPORTED_LOCALES'));

        foreach (scandir($this->directory . getLocaleManta()) as $keyf => $valuef) :
            if (!is_dir($this->directory . '/' . getLocaleManta() . $valuef) && $valuef != '.' && $valuef != '..') :
                $this->translate_files[] = $valuef;
            endif;
        endforeach;
        $this->getBreadcrumb();
    }

    public function render()
    {
        $items = scandir($this->directory . $this->directory_add);

        return view('livewire.manta.translator.translator-list', ['items' => $items])->title('Vertaal bestanden');
    }

    public function getBreadcrumb()
    {
        $this->breadcrumb = [
            ["title" => $this->breadcumbHomeName, "url" => route('cms.dashboard')],
            ["title" => $this->moduleTitle],
        ];
    }

    public function readFile($file)
    {
        $location = $this->directory . $this->directory_add . $file;
        if (pathinfo($location)['extension'] == 'json') {
            // json_decode(file_get_contents($location), true);
        } elseif (pathinfo($location)['extension'] == 'php') {
            // include($location);
        }
    }

    public function createMissing()
    {
        $translate = new TranslateClient([
            'key' => env('GOOGLE_KEY_PHP')
        ]);


        foreach (getLocalesManta() as $lang) {
            foreach ($this->translate_files as $keyf => $valuef) {
                if (!file_exists($this->directory   .  $lang['locale'] . '/' . $valuef)) {
                    $location = $this->directory   .  getLocaleManta() . '/' . $valuef;

                    if (pathinfo($location)['extension'] == 'json') {
                        $items = json_decode(file_get_contents($location), true);
                    } elseif (pathinfo($location)['extension'] == 'php') {
                        $items = include($location);
                    }
                    $new_arr = [];
                    foreach ($items as $key => $value) {
                        $result = $translate->translate((string)$value, [
                            'source' => getLocaleManta(),
                            'target' => $lang['locale']
                        ]);
                        $answer = $result['text'];
                        if (str_contains($valuef, 'route')) {
                            $answer = Str::slug($answer);
                        }
                        $new_arr[$key] = $answer;
                    }
                    if (!is_dir($this->directory   .  $lang['locale'])) {
                        mkdir($this->directory   .  $lang['locale'], 0770, true);
                    }
                    if (pathinfo($location)['extension'] == 'json') {
                        $jsonString = json_encode($new_arr, JSON_PRETTY_PRINT);
                        // Write in the file
                        $fp = fopen($this->directory   .  $lang['locale'] . '/' . $valuef, 'w');
                        fwrite($fp, $jsonString);
                        fclose($fp);
                    } else {
                        file_put_contents($this->directory   .  $lang['locale'] . '/' . $valuef, '<?php' . PHP_EOL . PHP_EOL . ' return ' . var_export($new_arr, true) . ';');
                    }
                }
            }
        }
    }
}

<?php

use Illuminate\Support\Facades\File;

if (!function_exists('cms_config')) {
    function cms_config($name = 'manta')
    {
        $path = app_path("../manta/config/{$name}.php");
        $pathTheme = app_path("../manta/config/{$name}_" . env('THEME') . ".php");

        if (File::exists($pathTheme)) {
            return include($pathTheme);
        } elseif (!File::exists($path)) {
            return config('manta_cms');
        }

        return include($path);
    }
}
if (!function_exists('manta_config')) {
    function manta_config($name)
    {
        $themeConfigPath = app_path("/Livewire/Manta/{$name}/Config/{$name}Config_" . env('THEME') . ".php");
        $defaultConfigPath = app_path("/Livewire/Manta/{$name}/Config/{$name}_config.php");
        $appFallbackConfigPath = app_path("/Livewire/Manta/{$name}/Config/{$name}Config_default.php");
        $packageFallbackConfigPath = __DIR__ . "/../Livewire/Page/Config/PageConfig_default.php";

        if (File::exists($themeConfigPath)) {
            return include($themeConfigPath);
        } elseif (File::exists($defaultConfigPath)) {
            return include($defaultConfigPath);
        } elseif (File::exists($appFallbackConfigPath)) {
            return include($appFallbackConfigPath);
        } else {
            return include($packageFallbackConfigPath);
        }
    }
}

if (!function_exists('module_config')) {
    function module_config($name)
    {
        $themeConfigPath = app_path("/Livewire/Manta/{$name}/Config/{$name}Config_" . env('THEME') . ".php");
        $defaultConfigPath = app_path("/Livewire/Manta/{$name}/Config/{$name}_config.php");
        $fallbackConfigPath = app_path("/Livewire/Manta/{$name}/Config/{$name}Config_default.php");
        $packageFallbackConfigPath = __DIR__ . "/../Livewire/Page/Config/PageConfig_default.php";

        if (File::exists($themeConfigPath)) {
            return include($themeConfigPath);
        } elseif (File::exists($defaultConfigPath)) {
            return include($defaultConfigPath);
        } elseif (File::exists($packageFallbackConfigPath)) {
            return include($packageFallbackConfigPath);
        } else {
            return include($fallbackConfigPath);
        }
    }
}

if (!function_exists('generatePassword')) {
    function generatePassword($length = 12, $includeNumbers = true, $includeLetters = true, $includeSpecialChars = true)
    {
        $numbers = '0123456789';
        $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $specialChars = '!@#$%^&*()_-=+;:,.?';
        if (!$includeLetters || !$includeNumbers || !$includeSpecialChars) {
            return 'Om aan de minimumvereisten te voldoen, moeten letters, cijfers en speciale tekens zijn ingeschakeld.';
        }
        $characters = '';
        if ($includeNumbers) {
            $characters .= $numbers;
        }
        if ($includeLetters) {
            $characters .= $letters;
        }
        if ($includeSpecialChars) {
            $characters .= $specialChars;
        }
        if ($characters === '') {
            return 'Please enable at least one character type.';
        }
        $password = '';
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $specialChars[random_int(0, strlen($specialChars) - 1)];
        $charactersLength = strlen($characters);
        for ($i = 4; $i < $length; $i++) {
            $password .= $characters[random_int(0, $charactersLength - 1)];
        }
        $passwordArray = str_split($password);
        shuffle($passwordArray);
        return implode('', $passwordArray);
    }
}


if (!function_exists('getLocaleManta')) {
    function getLocaleManta()
    {
        return env('APP_LOCALE');
    }
}

if (!function_exists('getLocalesManta')) {
    function getLocalesManta()
    {
        $arr = [
            ['locale' => 'nl', 'class' => 'fi-nl', 'title' => 'Nederlands'],
            ['locale' => 'en', 'class' => 'fi-en', 'title' => 'Engels'],
            ['locale' => 'de', 'class' => 'fi-de', 'title' => 'Duits'],
            ['locale' => 'sv', 'class' => 'fi-sv', 'title' => 'Zweeds'],
            ['locale' => 'es', 'class' => 'fi-es', 'title' => 'Spaans'],
            ['locale' => 'fr', 'class' => 'fi-fr', 'title' => 'Frans'],
        ];

        $supported = explode(',', env('SUPPORTED_LOCALES'));

        return collect($arr)
            ->filter(fn($row) => in_array($row['locale'], $supported))
            ->values()
            ->all();
    }
}


if (!function_exists('getRoutesManta')) {
    function getRoutesManta()
    {
        // De gewenste taal ophalen uit de omgeving
        $appLocale = env('APP_LOCALE', 'nl');

        return collect(Illuminate\Support\Facades\Route::getRoutes())
            ->pluck('action.as')
            ->filter()
            ->map(function ($routeName) use ($appLocale) {
                // Controleer of de route begint met de taalprefix
                if (preg_match('/^' . $appLocale . '\.(.+)$/', $routeName, $matches)) {
                    return $matches[1]; // Gebruik de route zonder taalprefix
                }
                // Als er geen taalprefix is, behoud de originele naam
                return $routeName;
            })
            ->filter(function ($routeName) {
                // Controleer of de route begint met 'website.'
                return Illuminate\Support\Str::startsWith($routeName, 'website.');
            })
            ->unique()
            ->sort()
            ->values()
            ->mapWithKeys(function ($routeName) {
                // Gebruik vertaling of val terug op de route naam
                return [$routeName => $routeName];
            })
            ->toArray();
    }
}
if (!function_exists('word_wrap')) {
    function word_wrap($string, $maxWords = 10)
    {
        $words = explode(' ', $string);
        $chunks = array_chunk($words, $maxWords);
        return implode("\n", array_map(fn($chunk) => implode(' ', $chunk), $chunks));
    }
}


if (!function_exists('translate')) {
    function translate(object $item, ?string $locale = null)
    {
        // Standaardtaal instellen als geen taal is opgegeven
        $locale = $locale ?: app()->getLocale();
        // Oorspronkelijk en resultaat in een array initialiseren
        $translation = ['org' => $item, 'result' => $item];
        // Controleren of de opgegeven taal verschilt van de standaardtaal
        // Probeer een vertaling te vinden voor het opgegeven item en taal
        $translatedItem = get_class($item)::where(['pid' => $item->id, 'locale' => $locale])->first();
        // Als een vertaling is gevonden, bijwerken van het resultaat
        if ($translatedItem) {
            $translation['result'] = $translatedItem;
        }
        return $translation;
    }
}

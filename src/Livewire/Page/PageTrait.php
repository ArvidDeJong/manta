<?php

namespace Darvis\Manta\Livewire\Page;

use Darvis\Manta\Models\Page;
use Darvis\Manta\Services\Openai;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Locked;

trait PageTrait
{
    public function __construct()
    {
        $this->route_name = 'page';
        $this->route_list = route($this->route_name . '.list');
        $this->config = manta_config('Page');
        $this->fields = $this->config['fields'];
        $this->moduleClass = 'Darvis\Manta\Models\Page';
        $this->tab_title = isset($this->config['tab_title']) ? $this->config['tab_title'] : null;
    }

    public ?Page $item = null;
    public ?Page $itemOrg = null;

    public ?string $company_id = '1';
    public ?string $locale = null;
    public ?string $pid = null;

    public ?string $description = null;
    public ?string $title = null;
    public ?string $title_2 = null;
    public ?string $title_3 = null;
    public ?string $title_4 = null;

    public ?string $seo_title = null;
    public ?string $seo_description = null;
    public ?string $tags = null;
    public ?string $excerpt = null;
    public ?string $content = null;
    public ?string $template = null;
    public ?bool $homepage = false;
    public ?int $homepageSort = 0;
    public ?bool $locked = true;
    public ?bool $fullpage = true;
    public ?string $link = null;
    public ?string $route = null;
    public ?string $route_title = null;
    public ?bool $option_1 = false;
    public ?bool $option_2 = false;
    public ?bool $option_3 = false;
    public ?bool $option_4 = false;



    protected function applySearch($query)
    {
        return $this->search === ''
            ? $query
            : $query->where(function (Builder $querysub) {
                $querysub->where('title', 'LIKE', "%{$this->search}%")
                    ->orWhere('content', 'LIKE', "%{$this->search}%");
            });
    }

    public function rules()
    {
        $return = [];

        // Validatie voor 'description'
        if ($this->fields['description']['active'] == true) {
            $return['description'] = $this->fields['description']['required'] == true ? 'required|string|max:255' : 'nullable|string|max:255';
        }

        // Validatie voor 'title'
        if ($this->fields['title']['active'] == true) {
            $return['title'] = $this->fields['title']['required'] == true ? 'required|string|max:255' : 'nullable|string|max:255';
        }

        // Validatie voor 'title_2'
        if ($this->fields['title_2']['active'] == true) {
            $return['title_2'] = $this->fields['title_2']['required'] == true ? 'required|string|max:255' : 'nullable|string|max:255';
        }

        // Validatie voor 'slug'
        if (isset($this->fields['slug']) && $this->fields['slug']['active'] == true) {
            if ($this->item) {
                $return['slug'] = $this->fields['slug']['required'] == true ? 'required|string|max:255|unique:pages,slug,' . $this->item->id : 'nullable|string|max:255|unique:pages,slug';
            } else {
                $return['slug'] = $this->fields['slug']['required'] == true ? 'required|string|max:255|unique:pages,slug' : 'nullable|string|max:255|unique:pages,slug';
            }
        }

        // Validatie voor 'seo_title'
        if ($this->fields['seo_title']['active'] == true) {
            $return['seo_title'] = $this->fields['seo_title']['required'] == true ? 'required|string|max:255' : 'nullable|string|max:255';
        }

        // Validatie voor 'seo_description'
        if ($this->fields['seo_description']['active'] == true) {
            $return['seo_description'] = $this->fields['seo_description']['required'] == true ? 'required|string|max:160' : 'nullable|string|max:160';
        }

        // Validatie voor 'tags'
        if ($this->fields['tags']['active'] == true) {
            $return['tags'] = $this->fields['tags']['required'] == true ? 'required|string|max:255' : 'nullable|string|max:255';
        }

        // Validatie voor 'excerpt'
        if ($this->fields['excerpt']['active'] == true) {
            $return['excerpt'] = $this->fields['excerpt']['required'] == true ? 'required|string|max:500' : 'nullable|string|max:500';
        }

        // Validatie voor 'content'
        if ($this->fields['content']['active'] == true) {
            $return['content'] = $this->fields['content']['required'] == true ? 'required|string' : 'nullable|string';
        }

        // Validatie voor 'homepage'
        if ($this->fields['homepage']['active'] == true) {
            $return['homepage'] = $this->fields['homepage']['required'] == true ? 'required|boolean' : 'nullable|boolean';
        }

        // Validatie voor 'locked'
        if ($this->fields['locked']['active'] == true) {
            $return['locked'] = $this->fields['locked']['required'] == true ? 'required|boolean' : 'nullable|boolean';
        }

        // Validatie voor 'fullpage'
        if ($this->fields['fullpage']['active'] == true) {
            $return['fullpage'] = $this->fields['fullpage']['required'] == true ? 'required|boolean' : 'nullable|boolean';
        }

        return $return;
    }


    public function messages()
    {
        $return = [];

        // Foutmeldingen voor 'title'
        $return['title.required'] = 'De titel is verplicht.';
        $return['title.string'] = 'De titel moet een geldige tekst zijn.';
        $return['title.max'] = 'De titel mag niet langer zijn dan 255 tekens.';

        // Foutmeldingen voor 'title_2'
        $return['title_2.required'] = 'De subtitel is verplicht.';
        $return['title_2.string'] = 'De subtitel moet een geldige tekst zijn.';
        $return['title_2.max'] = 'De subtitel mag niet langer zijn dan 255 tekens.';

        // Foutmeldingen voor 'slug'
        $return['slug.required'] = 'De slug is verplicht.';
        $return['slug.string'] = 'De slug moet een geldige tekst zijn.';
        $return['slug.max'] = 'De slug mag niet langer zijn dan 255 tekens.';
        $return['slug.unique'] = 'De slug moet uniek zijn. Een slug met deze waarde bestaat al.';

        // Foutmeldingen voor 'seo_title'
        $return['seo_title.required'] = 'De SEO-titel is verplicht.';
        $return['seo_title.string'] = 'De SEO-titel moet een geldige tekst zijn.';
        $return['seo_title.max'] = 'De SEO-titel mag niet langer zijn dan 255 tekens.';

        // Foutmeldingen voor 'seo_description'
        $return['seo_description.required'] = 'De SEO-omschrijving is verplicht.';
        $return['seo_description.string'] = 'De SEO-omschrijving moet een geldige tekst zijn.';
        $return['seo_description.max'] = 'De SEO-omschrijving mag niet langer zijn dan 160 tekens.';

        // Foutmeldingen voor 'tags'
        $return['tags.required'] = 'De tags zijn verplicht.';
        $return['tags.string'] = 'De tags moeten een geldige tekst zijn.';
        $return['tags.max'] = 'De tags mogen niet langer zijn dan 255 tekens.';

        // Foutmeldingen voor 'excerpt'
        $return['excerpt.required'] = 'Het uittreksel is verplicht.';
        $return['excerpt.string'] = 'Het uittreksel moet een geldige tekst zijn.';
        $return['excerpt.max'] = 'Het uittreksel mag niet langer zijn dan 500 tekens.';

        // Foutmeldingen voor 'content'
        $return['content.required'] = 'De inhoud is verplicht.';
        $return['content.string'] = 'De inhoud moet een geldige tekst zijn.';

        // Foutmeldingen voor 'homepage'
        $return['homepage.required'] = 'Geef aan of de pagina een homepage is.';
        $return['homepage.boolean'] = 'Het veld homepage moet waar of onwaar zijn.';

        // Foutmeldingen voor 'locked'
        $return['locked.required'] = 'Geef aan of de pagina vergrendeld is.';
        $return['locked.boolean'] = 'Het veld vergrendeld moet waar of onwaar zijn.';

        // Foutmeldingen voor 'fullpage'
        $return['fullpage.required'] = 'Geef aan of de pagina fullscreen is.';
        $return['fullpage.boolean'] = 'Het veld fullscreen moet waar of onwaar zijn.';

        return $return;
    }
}

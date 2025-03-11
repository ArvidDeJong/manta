<?php

namespace Darvis\Manta\Livewire\Mailtrap;

use Darvis\Manta\Models\Mailtrap;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\Locked;

trait MailtrapTrait
{
    public function __construct()
    {
        $this->route_name = 'mailtrap';
        $this->route_list = route($this->route_name . '.list');
        $this->config = manta_config('Mailtrap');
        $this->fields = $this->config['fields'];
        $this->tab_title = isset($this->config['tab_title']) ? $this->config['tab_title'] : null;
        $this->moduleClass = 'Darvis\Manta\Models\Mailtrap';
    }

    public ?Mailtrap $item = null;
    public ?Mailtrap $itemOrg = null;





    #[Locked]
    public ?string $company_id = null;

    #[Locked]
    public ?string $host = null;

    public ?string $email = null;
    public ?string $event = null;
    public ?string $timestamp = null;
    public ?string $sending_stream = null;
    public ?string $category = null;
    public ?string $message_id = null;
    public ?string $event_id = null;
    public ?array $custom_variables = null;

    protected function applySearch($query)
    {
        return $this->search === ''
            ? $query
            : $query->where(function (Builder $querysub) {
                $querysub->where('email', 'LIKE', "%{$this->search}%")
                    ->orWhere('event', 'LIKE', "%{$this->search}%")
                    ->orWhere('sending_stream', 'LIKE', "%{$this->search}%")
                    ->orWhere('category', 'LIKE', "%{$this->search}%")
                    ->orWhere('custom_variables', 'LIKE', "%{$this->search}%");
            });
    }

    public function rules()
    {
        $return = [];

        if ($this->fields['email']['active'] == true && $this->fields['email']['required'] == true) {
            $return['email'] = 'required|string|max:255|email';
        }
        if ($this->fields['event']['active'] == true && $this->fields['event']['required'] == true) {
            $return['event'] = 'required|string|max:255';
        }
        if ($this->fields['timestamp']['active'] == true && $this->fields['timestamp']['required'] == true) {
            $return['timestamp'] = 'required|date';
        }
        if ($this->fields['sending_stream']['active'] == true && $this->fields['sending_stream']['required'] == true) {
            $return['sending_stream'] = 'required|string|max:255';
        }
        if ($this->fields['category']['active'] == true && $this->fields['category']['required'] == true) {
            $return['category'] = 'required|string|max:255';
        }
        if ($this->fields['message_id']['active'] == true && $this->fields['message_id']['required'] == true) {
            $return['message_id'] = 'required|string|max:255';
        }
        if ($this->fields['event_id']['active'] == true && $this->fields['event_id']['required'] == true) {
            $return['event_id'] = 'required|string|max:255';
        }
        if ($this->fields['custom_variables']['active'] == true && $this->fields['custom_variables']['required'] == true) {
            $return['custom_variables'] = 'required|array';
        }

        return $return;
    }


    public function messages()
    {
        return [
            // Foutmeldingen voor 'email'
            'email.required' => 'Het e-mailadres is verplicht.',
            'email.string' => 'Het e-mailadres moet een geldige tekst zijn.',
            'email.max' => 'Het e-mailadres mag niet langer zijn dan 255 tekens.',
            'email.email' => 'Het e-mailadres moet een geldig e-mailadres zijn.',

            // Foutmeldingen voor 'event'
            'event.required' => 'Het event is verplicht.',
            'event.string' => 'Het event moet een geldige tekst zijn.',
            'event.max' => 'Het event mag niet langer zijn dan 255 tekens.',

            // Foutmeldingen voor 'timestamp'
            'timestamp.required' => 'De tijdstempel is verplicht.',
            'timestamp.date' => 'De tijdstempel moet een geldige datum zijn.',

            // Foutmeldingen voor 'sending_stream'
            'sending_stream.required' => 'De verzendstroom is verplicht.',
            'sending_stream.string' => 'De verzendstroom moet een geldige tekst zijn.',
            'sending_stream.max' => 'De verzendstroom mag niet langer zijn dan 255 tekens.',

            // Foutmeldingen voor 'category'
            'category.required' => 'De categorie is verplicht.',
            'category.string' => 'De categorie moet een geldige tekst zijn.',
            'category.max' => 'De categorie mag niet langer zijn dan 255 tekens.',

            // Foutmeldingen voor 'message_id'
            'message_id.required' => 'Het bericht-ID is verplicht.',
            'message_id.string' => 'Het bericht-ID moet een geldige tekst zijn.',
            'message_id.max' => 'Het bericht-ID mag niet langer zijn dan 255 tekens.',

            // Foutmeldingen voor 'event_id'
            'event_id.required' => 'Het event-ID is verplicht.',
            'event_id.string' => 'Het event-ID moet een geldige tekst zijn.',
            'event_id.max' => 'Het event-ID mag niet langer zijn dan 255 tekens.',

            // Foutmeldingen voor 'custom_variables'
            'custom_variables.required' => 'De aangepaste variabelen zijn verplicht.',
            'custom_variables.array' => 'De aangepaste variabelen moeten een geldige array zijn.',
        ];
    }
}

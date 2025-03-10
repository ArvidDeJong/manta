# Manta CMS

Een krachtig, out-of-the-box Content Management Systeem voor Laravel 11+ applicaties.
Manta is geoptimaliseerd voor Livewire 3.0, wat resulteert in een moderne en snelle CMS oplossing die direct klaar is voor gebruik.

## Versie

Huidige versie: 1.0.4

## Vereisten

- PHP 8.0 of hoger
- Laravel 11 of 12
- Livewire 3.0
- Laravel Jetstream 5.0

## Installatie

Je kunt Manta CMS installeren via Composer:

```bash
composer require darvis/manta
```

De service provider wordt automatisch geregistreerd via Laravel's package discovery.

### Assets Publiceren

Je kunt de assets (CSS, JavaScript, afbeeldingen) publiceren met:

```bash
php artisan vendor:publish --tag=manta-assets
```

Dit zal alle assets kopiëren naar de `public/vendor/manta` map van je applicatie.

### Configuratie en Views

Publiceer de configuratie en views met:

```bash
php artisan vendor:publish --tag=manta-resources
```

Dit zal de volgende bestanden publiceren:

- Config bestanden
- Views
- Vertalingen

### Database Migraties

Voer de migraties uit om de benodigde database tabellen aan te maken:

```bash
php artisan migrate
```

## Features

Manta CMS biedt de volgende functionaliteit:

### Content Beheer

- Volledig beheer van pagina's en content
- Bestandsbeheer met geavanceerde upload mogelijkheden
- Meertaligheid ondersteuning (NL/EN)
- Gebruikersbeheer met uitgebreide rechtenstructuur
- Staff authenticatie met eigen guard

### Blade Componenten

Manta bevat verschillende handige Blade componenten:

- `<x-manta::website.page />`: Voor het weergeven van pagina's
- `<x-manta::website.translator />`: Voor vertalingsfunctionaliteit

### Livewire Componenten

Manta bevat verschillende Livewire componenten, waaronder:

- Page componenten
- Staff componenten
- User componenten
- Upload componenten
- Translator componenten

### Models

De CMS bevat verschillende basis models:

- `Upload`: Voor het beheren van bestandsuploads
- `User`: Een uitgebreid user model met extra functionaliteit
- `Staff`: Voor beheerders met eigen authenticatie
- `Page`: Voor het beheren van pagina's

Je kunt deze models uitbreiden of gebruiken als basis voor je eigen models.

### Traits

De CMS bevat verschillende handige traits die je kunt gebruiken om je models uit te breiden:

- `HasTranslations`: Voor het toevoegen van vertalingen aan je models
- `HasUploads`: Voor het beheren van bestandsuploads
- `MantaMaps`: Voor integratie met kaartfunctionaliteit
- `MantaPagerow`: Voor paginering functionaliteit
- `Manta`: Basis Manta functionaliteit
- `Sortable`: Voor het sorteren van models
- `Website`: Voor website-specifieke functionaliteit
- `WithSorting`: Voor geavanceerde sorteerfunctionaliteit
- `StaffTrait`: Voor Staff functionaliteit
- `TableRowTrait`: Voor tabelweergave

### Views

De CMS bevat een complete set van voorgedefinieerde views en layouts die je kunt gebruiken of uitbreiden.

### Helpers

Er zijn verschillende helper functies beschikbaar die je kunt gebruiken in je applicatie.

## Uitbreiden

### Models Uitbreiden

Je kunt de basis models uitbreiden:

```php
use Darvis\Manta\Models\User as MantaUser;

class User extends MantaUser
{
    // Je eigen functionaliteit hier
}
```

### Traits Gebruiken

Je kunt de traits toevoegen aan je models:

```php
use Darvis\Manta\Traits\HasTranslations;
use Darvis\Manta\Traits\Sortable;

class YourModel extends Model
{
    use HasTranslations;
    use Sortable;
}
```

## Toekomstige ontwikkeling

Dit is slechts het begin voor Manta. Toekomstige updates zullen nieuwe functionaliteiten, verbeterde prestaties en uitgebreidere documentatie bevatten.

## Feedback en bijdragen

Feedback, bug reports en pull requests zijn van harte welkom. Samen kunnen we Manta nog beter maken.

## Licentie

Deze CMS is open-source software gelicenseerd onder de [MIT licentie](LICENSE).

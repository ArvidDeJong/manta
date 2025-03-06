# Manta CMS

Een krachtig, out-of-the-box Content Management Systeem voor Laravel 11+ applicaties.
Manta is gebaseerd op Flux 2.0 en geoptimaliseerd voor Livewire 3.0, wat resulteert in een moderne en snelle CMS oplossing die direct klaar is voor gebruik.

## Vereisten

- PHP 8.0 of hoger
- Laravel 11 of hoger
- Livewire 3.0 of hoger

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
php artisan vendor:publish --provider="Darvis\\Manta\\MantaServiceProvider"
```

Of specifiek alleen de resources:

```bash
php artisan vendor:publish --tag=manta-resources
```

Dit zal de volgende bestanden publiceren:

- Config bestanden
- Views
- Migraties

## Features

Manta CMS biedt de volgende functionaliteit:

### Content Beheer

- Volledig beheer van pagina's en content
- Bestandsbeheer met geavanceerde upload mogelijkheden
- Meertaligheid ondersteuning
- Gebruikersbeheer met uitgebreide rechtenstructuur

### Models

De CMS bevat twee basis models:

- `Upload`: Voor het beheren van bestandsuploads
- `User`: Een uitgebreid user model met extra functionaliteit

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

### Views

De CMS bevat een complete set van voorgedefinieerde views en layouts die je kunt gebruiken of uitbreiden.

### Helpers

Er zijn verschillende helper functies beschikbaar die je kunt gebruiken in je applicatie.

### Database Migraties

De CMS bevat alle benodigde database migraties die automatisch worden uitgevoerd tijdens de installatie.

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

## Documentatie

[Gedetailleerde documentatie over het gebruik van de CMS, models, traits, views en helpers volgt]

## Licentie

Deze CMS is open-source software gelicenseerd onder de [MIT licentie](LICENSE).

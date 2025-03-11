# Manta CMS

A powerful, out-of-the-box Content Management System for Laravel 11+ applications.
Manta is optimized for Livewire 3.0, resulting in a modern and fast CMS solution that's ready to use.

## Version

Current version: 1.0.4

## Requirements

- PHP 8.0 or higher
- Laravel 11 or 12
- Livewire 3.0
- Laravel Jetstream 5.0

## Installation

You can install Manta CMS via Composer:

```bash
composer require darvis/manta
```

The service provider will be automatically registered via Laravel's package discovery.

### Publishing Assets

You can publish the assets (CSS, JavaScript, images) with:

```bash
php artisan vendor:publish --tag=manta-assets
```

This will copy all assets to your application's `public/vendor/manta` directory.

### Configuration and Views

Publish the configuration and views with:

```bash
php artisan vendor:publish --tag=manta-resources
```

This will publish the following files:

- Config files
- Views
- Translations

### Database Migrations and Seeders

Run the migrations to create the required database tables:

```bash
php artisan migrate
```

Publish and run the database seeders:

```bash
# Publish all seeders
php artisan vendor:publish --tag=manta-seeders

# Run all seeders at once
php artisan db:seed --class="Database\Seeders\MantaDatabaseSeeder"

# Or run individual seeders:
php artisan db:seed --class="Database\Seeders\MantaStaffSeeder"  # Only seed staff
php artisan db:seed --class="Database\Seeders\MantaUserSeeder"   # Only seed users
```

## Features

Manta CMS offers the following functionality:

### Content Management

- Full page and content management
- File management with advanced upload capabilities
- Multilingual support (NL/EN)
- User management with extensive permission structure
- Staff authentication with dedicated guard

### Blade Components

Manta includes several useful Blade components:

- `<x-manta::website.page />`: For displaying pages
- `<x-manta::website.translator />`: For translation functionality

### Livewire Components

Manta includes various Livewire components, including:

- Page components
- Staff components
- User components
- Upload components
- Translator components

### Models

The CMS includes several base models:

- `Upload`: For managing file uploads
- `User`: An extensive user model with additional functionality
- `Staff`: For administrators with dedicated authentication
- `Page`: For managing pages

You can extend these models or use them as a base for your own models.

### Traits

The CMS includes several useful traits that you can use to extend your models:

- `HasTranslations`: For adding translations to your models
- `HasUploads`: For managing file uploads
- `MantaMaps`: For map functionality integration
- `MantaPagerow`: For pagination functionality
- `Manta`: Base Manta functionality
- `Sortable`: For model sorting
- `Website`: For website-specific functionality
- `WithSorting`: For advanced sorting functionality
- `StaffTrait`: For Staff functionality
- `TableRowTrait`: For table display

### Views

The CMS includes a complete set of predefined views and layouts that you can use or extend.

### Helpers

Various helper functions are available for use in your application.

## Extending

### Extending Models

You can extend the base models:

```php
use Darvis\Manta\Models\User as MantaUser;

class User extends MantaUser
{
    // Your custom functionality here
}
```

### Using Traits

You can add the traits to your models:

```php
use Darvis\Manta\Traits\HasTranslations;
use Darvis\Manta\Traits\Sortable;

class YourModel extends Model
{
    use HasTranslations;
    use Sortable;
}
```

## Future Development

This is just the beginning for Manta. Future updates will include new features, improved performance, and more extensive documentation.

## Feedback and Contributions

Feedback, bug reports, and pull requests are welcome. Together we can make Manta even better.

## License

This CMS is open-source software licensed under the [MIT license](LICENSE).

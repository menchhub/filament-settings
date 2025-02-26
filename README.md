# Filament Settings Package for Laravel

This package provides reusable settings pages for Filament admin, powered by Spatie Laravel Settings.

## Installation

Install via composer:

```bash
composer require menchhub/filament-settings
```

Publish configuration and migrations:

```bash
php artisan vendor:publish --tag=filament-settings-config
php artisan vendor:publish --tag=filament-settings-migrations
php artisan migrate
```

## Usage

Add the service provider to `config/app.php` if not auto-discovered:

```php
Menchhub\FilamentSettings\SettingsServiceProvider::class,
```

Settings pages will automatically register in Filament.

## Customization

You can customize settings groups/pages in the `config/filament-settings.php` file.


add this to panel
```php
->plugins([
MenchFilamentSettingsPlugin::make()
->setSort(3)
->setIcon('heroicon-o-cog')
->setNavigationGroup('Settings')
->setTitle('Main Settings')
->setNavigationLabel('Mench Settings'),
])
```


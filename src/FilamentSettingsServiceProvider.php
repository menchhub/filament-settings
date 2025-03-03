<?php

namespace Menchhub\FilamentSettings;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Menchhub\FilamentSettings\Analytics\GoogleAnalyticsManager;
use Menchhub\FilamentSettings\Broadcasting\PusherConfigManager;
use Menchhub\FilamentSettings\Mail\EmailConfigManager;
use Menchhub\FilamentSettings\Seo\SeoConfigManager;
use Menchhub\FilamentSettings\Theme\ThemeManager;
use Menchhub\FilamentSettings\Branding\FilamentBrandingManager;


class FilamentSettingsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->publishes([
            __DIR__ . '/../config/filament-settings.php' => config_path('filament-settings.php'),
        ], 'filament-settings-config');


        $this->loadViewsFrom(__DIR__.'/../resources/views', 'filament-settings');


        Filament::serving(function () {
            EmailConfigManager::apply();
            PusherConfigManager::apply();
            SeoConfigManager::apply();
            GoogleAnalyticsManager::apply();
            FilamentBrandingManager::apply();
        });

        // Organize publishes in a separate method
        $this->registerPublishes();

        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    public function register(): void
    {

    }

    // Move publishes here
    protected function registerPublishes(): void
    {
        // Migrations
        // Check if the migration already exists to prevent duplicates
        $migrationFileName = collect(glob(database_path('migrations/*.php')))
            ->map(fn ($path) => basename($path))
            ->first(fn ($filename) => str_ends_with($filename, '_create_settings_table.php'));

        if (!$migrationFileName) { // ✅ Only publish if migration does not exist
            $this->publishes([
                __DIR__ . '/../database/migrations/create_settings_table.php' => database_path('migrations/' . date('Y_m_d_His') . '_create_settings_table.php'),
            ], 'filament-settings-migrations');
        }

        // Config file
        $this->publishes([
            __DIR__ . '/../config/filament-settings.php' => config_path('filament-settings.php'),
        ], 'filament-settings-config');

        // Footer view
        $this->publishes([
            __DIR__.'/../resources/views/filament/footer.blade.php' => resource_path('views/filament/footer.blade.php'),
        ], 'filament-settings-views');

        // SEO Blade partial
        $this->publishes([
            __DIR__.'/../resources/views/partials/seo.blade.php' => resource_path('views/vendor/filament-settings/partials/seo.blade.php'),
        ], 'filament-settings-views');

        // Google Analytics Blade partial
        $this->publishes([
            __DIR__.'/../resources/views/partials/google-analytics.blade.php' => resource_path('views/vendor/filament-settings/partials/google-analytics.blade.php'),
        ], 'filament-settings-views');

        // ✅ Publish the default image
        $this->publishes([
            __DIR__ . '/../resources/assets/default.png' => public_path('views/vendor/filament-settings/default.png'),
        ], 'filament-settings-assets');

//        $this->publishes([
//            __DIR__.'/../resources/views/themes/designs/default.png' => public_path('vendor/menchhub/filament-settings/default.png'),
//        ], 'filament-settings-assets');

    }



}

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


class SettingsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

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
        $this->mergeConfigFrom(
            __DIR__ . '/../config/filament-settings.php',
            'filament-settings'
        );
    }

    // Move publishes here
    protected function registerPublishes(): void
    {
        // Migrations
        $this->publishes([
            __DIR__ . '/../database/migrations/create_settings_table.php' => database_path('migrations/' . date('Y_m_d_His') . '_create_settings_table.php'),
        ], 'filament-settings-migrations');

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

    }



}

<?php

return [


    /*
     * Available Filament settings pages to register.
     */
    'pages' => [
        Menchhub\FilamentSettings\Filament\Pages\SiteSettingsPage::class,
    ],

    /*
     * Register the settings classes for Spatie Settings.
     */
    'settings' => [
        Menchhub\FilamentSettings\Settings\SiteSettings::class,
    ],
];
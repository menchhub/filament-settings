<?php

namespace Menchhub\FilamentSettings\Branding;

use Filament\Facades\Filament;
use Menchhub\FilamentSettings\Auth\MenchLogin;
use Menchhub\FilamentSettings\Settings\SiteSettings;

class FilamentBrandingManager
{
    public static function apply(): void
    {
        $settings = app(SiteSettings::class);

        $panel = Filament::getCurrentPanel();

        $panel->brandName($settings->site_name);
        $panel->favicon(asset('storage/' . $settings->site_favicon));

//        $panel->sidebarCollapsibleOnDesktop();


        $panel->sidebarFullyCollapsibleOnDesktop();

        if ($settings->site_logo) {
            $panel->brandLogo(asset('storage/' . $settings->site_logo));
            $panel->brandLogoHeight('2rem');
        }

    }
}

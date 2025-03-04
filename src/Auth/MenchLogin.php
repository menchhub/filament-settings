<?php

namespace Menchhub\FilamentSettings\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Menchhub\FilamentSettings\Settings\SiteSettings;

class MenchLogin extends BaseLogin
{
    protected static string $view = 'filament-settings::themes.designs.theme1';
    protected static string $layout = 'filament-settings::themes.base';

    /**
     * Get the data that should be available to the view.
     */
    protected function getViewData(): array
    {
        $settings = app(SiteSettings::class);

        // ✅ Ensure correct background image path
        $bgPhoto = $settings->lp_bg_photo;
        if ($bgPhoto && !str_starts_with($bgPhoto, 'storage/')) {
            $bgPhoto = 'storage/' . ltrim($bgPhoto, '/');
        }

        return [
            'settings' => [
                'backgroundImage' => asset($bgPhoto), // ✅ Background image
                'title' => $settings->lp_title ?? "Quote Of The Day",
                'description' => $settings->lp_description ?? "Ghana is a good place to spend time in Africa. YOO",
                'loginBgColor' => $settings->lp_login_bg_color ?? '#f7faff',
            ],
        ];
    }
}


<?php

namespace Menchhub\FilamentSettings\Theme;

use Filament\Support\Colors\Color;
use Filament\Panel;
use Filament\View\PanelsRenderHook;
use Menchhub\FilamentSettings\Auth\MenchLogin;
use Menchhub\FilamentSettings\Settings\SiteSettings;

class ThemeManager
{
    public static function apply(Panel $panel): void
    {
        $settings = app(SiteSettings::class);

        // ✅ Ensure the colors are properly formatted (always with a "#")
        $lightThemeColor = isset($settings->site_theme_light)
            ? '#' . ltrim($settings->site_theme_light, '#')
            : '#3b82f6'; // Default Blue

        $darkThemeColor = isset($settings->site_theme_dark)
            ? '#' . ltrim($settings->site_theme_dark, '#')
            : '#1f2937'; // Default Dark Gray

        // ✅ Apply theme colors directly to Filament
        $panel->colors([
            'primary' => Color::hex($lightThemeColor),
            'gray'    => Color::hex($darkThemeColor),
        ]);


        $panel->renderHook(PanelsRenderHook::CONTENT_END, function () use ($settings) {
            return '<div class="h-16"></div>';
        });


        $panel->renderHook(PanelsRenderHook::FOOTER, function () use ($settings) {
            return view('filament-settings::filament.footer', compact('settings'));
        });

        if ($settings->enable_lp) {
            $panel->login(MenchLogin::class);
        }

        $panel->renderHook(PanelsRenderHook::HEAD_START, function () {
            return view('filament-settings::partials.seo');
        });

        $panel->renderHook(PanelsRenderHook::HEAD_START, function () {
            return view('filament-settings::partials.google-analytics');
        });

        $panel->renderHook(PanelsRenderHook::HEAD_START, function () {
            return view('filament-settings::partials.pusher');
        });





    }
}

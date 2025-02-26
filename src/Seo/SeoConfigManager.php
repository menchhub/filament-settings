<?php

namespace Menchhub\FilamentSettings\Seo;

use Illuminate\Support\Facades\View;
use Menchhub\FilamentSettings\Settings\SiteSettings;

class SeoConfigManager
{
    public static function apply(): void
    {
        /** @var SiteSettings $settings */
        $settings = app(SiteSettings::class);

        View::share('seo', [
            'meta_title' => $settings->meta_title,
            'meta_description' => $settings->meta_description,
            'meta_keywords' => $settings->meta_keywords,
            'og_title' => $settings->og_title,
            'og_description' => $settings->og_description,
        ]);
    }
}

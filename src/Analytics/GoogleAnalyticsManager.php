<?php

namespace Menchhub\FilamentSettings\Analytics;

use Illuminate\Support\Facades\View;
use Menchhub\FilamentSettings\Settings\SiteSettings;

class GoogleAnalyticsManager
{
    public static function apply(): void
    {
        /** @var SiteSettings $settings */
        $settings = app(SiteSettings::class);

        if ($settings->enable_gna && !empty($settings->tracking_id)) {
            View::share('google_analytics', [
                'tracking_id' => $settings->tracking_id,
            ]);
        }
    }
}

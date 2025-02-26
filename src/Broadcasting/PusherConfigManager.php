<?php

namespace Menchhub\FilamentSettings\Broadcasting;

use Illuminate\Support\Facades\Config;
use Menchhub\FilamentSettings\Settings\SiteSettings;

class PusherConfigManager
{
    public static function apply(): void
    {
        $settings = app(SiteSettings::class);

        if (!$settings->enable_pusher) {
            return;
        }

        Config::set('broadcasting.connections.pusher', [
            'driver'  => 'pusher',
            'key'     => $settings->pusher_app_key ?? env('PUSHER_APP_KEY'),
            'secret'  => $settings->pusher_app_secret ?? env('PUSHER_APP_SECRET'),
            'app_id'  => $settings->pusher_app_id ?? env('PUSHER_APP_ID'),
            'options' => [
                'cluster'   => $settings->pusher_app_cluster ?? env('PUSHER_APP_CLUSTER', 'mt1'),
                'encrypted' => true,
            ],
        ]);
    }
}

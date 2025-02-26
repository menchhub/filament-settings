<?php

namespace Menchhub\FilamentSettings\Mail;

use Illuminate\Support\Facades\Config;
use Menchhub\FilamentSettings\Settings\SiteSettings;

class EmailConfigManager
{
    public static function apply(): void
    {
        /** @var SiteSettings $settings */
        $settings = app(SiteSettings::class);

        // Ensure mail driver has a default value (e.g., 'smtp')
        $mailDriver = $settings->mail_driver ?? 'smtp';

        // Set default mailer
        Config::set('mail.default', $mailDriver);

        // Ensure all required values have defaults
        Config::set('mail.mailers.' . $mailDriver, [
            'transport' => $mailDriver,
            'host' => $settings->mail_host ?? 'smtp.mailtrap.io',
            'port' => $settings->mail_port ?? 587,
            'username' => $settings->mail_username ?? null,
            'password' => $settings->mail_password ?? null,
            'encryption' => $settings->mail_encryption ?? 'tls',
            'timeout' => null,
            'auth_mode' => null,
        ]);

        // Ensure the "from" address is always set
        Config::set('mail.from', [
            'address' => $settings->mail_from_address ?? 'no-reply@example.com',
            'name' => $settings->mail_from_name ?? config('app.name', 'Application'),
        ]);
    }
}

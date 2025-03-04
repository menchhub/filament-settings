<?php

namespace Menchhub\FilamentSettings\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{
    // General Site Settings
    public string $site_name = '';
    public ?string $site_description = null;
    public ?string $site_email = null;
    public ?string $site_logo = null;
    public ?string $site_logo_dark = null;
    public ?string $site_favicon = null;
    public ?string $site_url = null;
    public ?string $site_theme_light = null;
    public ?string $site_theme_dark = null;
    public ?string $site_footer = null;

    // SEO Settings
    public string $meta_title = '';
    public string $meta_description = '';
    public string $meta_keywords = '';
    public string $og_title = '';
    public string $og_description = '';
    public ?string $og_image = null;
    public bool $enable_seo = false;

    // Email Settings
    public ?string $mail_mailer = null;
    public ?string $mail_host = null;
    public ?string $mail_port = null;
    public ?string $mail_username = null;
    public ?string $mail_password = null;
    public ?string $mail_encryption = null;
    public ?string $mail_from_address = null;
    public ?string $mail_from_name = null;
    public bool $enable_mail = false;

    // Google Analytics Settings
    public ?string $tracking_id = null;
    public bool $enable_gna = false;


    // Pusher Settings
    public ?string $app_id = null;
    public ?string $app_key = null;
    public ?string $app_secret = null;
    public ?string $app_cluster = null;
    public bool $enable_pusher = false;

    // Social Media Settings
    public ?string $facebook_url = null;
    public ?string $twitter_url = null;
    public ?string $instagram_url = null;
    public ?string $linkedin_url = null;
    public ?string $youtube_url = null;
    public ?string $whatsapp_url = null;
    public ?string $telegram_url = null;
    public bool $enable_sm = false;

//    Login Page

    public ?string $lp_bg_photo = null;
    public ?string $lp_title = null;
    public ?string $lp_description = null;
    public ?string $lp_login_bg_color = null;
    public bool $enable_lp = false;


    //   Theme Color Page

    public ?string $logo_color_bg_dark = null;
    public ?string $sidebar_color_bg_light = null;
    public ?string $sidebar_label_color_light = null;
    public ?string $sidebar_color_bg_dark = null;
    public ?string $sidebar_label_color_dark = null;

    public ?string $footer_color_bg_light = null;
    public ?string $footer_label_color_light = null;
    public ?string $footer_color_bg_dark = null;
    public ?string $footer_label_color_dark = null;
    public bool $enable_tc = false;
    public bool $enable_bc = false;




    public static function group(): string
    {
        return 'site';
    }
}

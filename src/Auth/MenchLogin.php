<?php

namespace Menchhub\FilamentSettings\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Form;
use Illuminate\Support\Facades\View;
use Menchhub\FilamentSettings\Settings\SiteSettings;

class MenchLogin extends BaseLogin
{
    public function __construct() {
        static::$view = 'filament-settings::themes.designs.theme1';
        static::$layout = 'filament-settings::themes.base';
    }


}

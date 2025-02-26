<?php

namespace Menchhub\FilamentSettings\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Menchhub\FilamentSettings\Settings\EmailSettings;
use Menchhub\FilamentSettings\Settings\PusherSettings;
use Menchhub\FilamentSettings\Settings\SeoSettings;
use Menchhub\FilamentSettings\Settings\SocialMediaSettings;
use Menchhub\FilamentSettings\Settings\SiteSettings;
use Menchhub\FilamentSettings\Settings\GoogleAnalyticsSettings;

class MenchSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Mench Settings';
    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $slug = 'mench-settings';

    protected static string $view = 'filament-settings::mench-settings';

    public array $siteSettings = [];
    public array $emailSettings = [];
    public array $pusherSettings = [];
    public array $seoSettings = [];
    public array $socialMediaSettings = [];
    public array $googleAnalyticsSettings = [];

    public function mount(): void
    {
        $this->siteSettings = app(SiteSettings::class)->toArray();

        $this->siteSettings['site_logo'] ??= null;

//        // Debugging - Check if siteSettings is actually an array
//        if (!is_array($this->siteSettings)) {
//            throw new \Exception('siteSettings is not an array! It is: ' . gettype($this->siteSettings));
//        }
//
//        \Log::info('Site Settings:', $this->siteSettings);
        $this->emailSettings = app(EmailSettings::class)->toArray();
        $this->pusherSettings = app(PusherSettings::class)->toArray();
        $this->seoSettings = app(SeoSettings::class)->toArray();
        $this->socialMediaSettings = app(SocialMediaSettings::class)->toArray();
        $this->googleAnalyticsSettings = app(GoogleAnalyticsSettings::class)->toArray();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Mench Settings')->tabs([
//                Forms\Components\Tabs\Tab::make('Site')
//                    ->schema(SiteSettingsPage::get())->statePath('siteSettings')
//                    ->icon('heroicon-o-tv')
//                    ->columns(3),
                Forms\Components\Tabs\Tab::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('seoSettings.meta_title')->required()->label('Meta Title'),
                        Forms\Components\TextInput::make('seoSettings.meta_description')->required()->label('Meta Description'),
                        Forms\Components\TextInput::make('seoSettings.meta_keywords')->required()->label('Meta Keywords'),
                        Forms\Components\TextInput::make('seoSettings.og_title')->required()->label('OG Title'),
                        Forms\Components\TextInput::make('seoSettings.og_description')->required()->label('OG Description'),
                    ])
                    ->icon('heroicon-o-globe-alt')
                    ->columns(2),
                Forms\Components\Tabs\Tab::make('Email')
                    ->schema([
                        Forms\Components\TextInput::make('emailSettings.mail_mailer')->required()->label('Mailer'),
                        Forms\Components\TextInput::make('emailSettings.mail_host')->required()->label('Host'),
                        Forms\Components\TextInput::make('emailSettings.mail_port')->required()->numeric()->label('Port'),
                        Forms\Components\TextInput::make('emailSettings.mail_username')->required()->label('Username'),
                        Forms\Components\TextInput::make('emailSettings.mail_password')->password()->required()->label('Password'),
                        Forms\Components\TextInput::make('emailSettings.mail_encryption')->required()->label('Encryption'),
                        Forms\Components\TextInput::make('emailSettings.mail_from_address')->email()->required()->label('From Address'),
                        Forms\Components\TextInput::make('emailSettings.mail_from_name')->required()->label('From Name'),
                    ])
                    ->icon('heroicon-o-tv')
                    ->columns(2),
                Forms\Components\Tabs\Tab::make('Social Media')
                    ->schema([
                        Forms\Components\TextInput::make('socialMediaSettings.facebook_url')->url()->label('Facebook URL'),
                        Forms\Components\TextInput::make('socialMediaSettings.twitter_url')->url()->label('Twitter URL'),
                        Forms\Components\TextInput::make('socialMediaSettings.instagram_url')->url()->label('Instagram URL'),
                        Forms\Components\TextInput::make('socialMediaSettings.linkedin_url')->url()->label('LinkedIn URL'),
                        Forms\Components\TextInput::make('socialMediaSettings.youtube_url')->url()->label('YouTube URL'),
                    ])
                    ->icon('heroicon-o-share')
                    ->columns(2),
                Forms\Components\Tabs\Tab::make('Google Analytics')
                    ->schema([
                        Forms\Components\TextInput::make('googleAnalyticsSettings.tracking_id')->label('Tracking ID'),
                        Forms\Components\Toggle::make('googleAnalyticsSettings.enabled')->label('Enabled'),
                        Forms\Components\TextInput::make('googleAnalyticsSettings.api_key')->label('API Key'),
                        Forms\Components\TextInput::make('googleAnalyticsSettings.client_id')->label('Client ID'),
                        Forms\Components\TextInput::make('googleAnalyticsSettings.view_id')->label('View ID'),
                    ])
                    ->icon('heroicon-o-chart-bar')
                    ->columns(2),
            ]),
        ]);
    }

    public function save(): void
    {
        $siteSettings = app(SiteSettings::class);
        $siteSettings->fill($this->siteSettings)->save();

        $emailSettings = app(EmailSettings::class);
        $emailSettings->fill($this->emailSettings)->save();

        $pusherSettings = app(PusherSettings::class);
        $pusherSettings->fill($this->pusherSettings)->save();

        $seoSettings = app(SeoSettings::class);
        $seoSettings->fill($this->seoSettings)->save();

        $socialMediaSettings = app(SocialMediaSettings::class);
        $socialMediaSettings->fill($this->socialMediaSettings)->save();

        $googleAnalyticsSettings = app(GoogleAnalyticsSettings::class);
        $googleAnalyticsSettings->fill($this->googleAnalyticsSettings)->save();

        $this->siteSettings = $siteSettings->toArray();
        $this->emailSettings = $emailSettings->toArray();
        $this->pusherSettings = $pusherSettings->toArray();
        $this->seoSettings = $seoSettings->toArray();
        $this->socialMediaSettings = $socialMediaSettings->toArray();
        $this->googleAnalyticsSettings = $googleAnalyticsSettings->toArray();

        \Filament\Notifications\Notification::make()
            ->title('Settings saved successfully.')
            ->success()
            ->send();
    }

    protected function getActions(): array
    {
        return [
            Action::make('Save Settings')
                ->action('save')
                ->label('Save')
                ->color('primary'),
        ];
    }


}
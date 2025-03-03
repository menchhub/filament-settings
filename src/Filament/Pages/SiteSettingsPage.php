<?php

namespace Menchhub\FilamentSettings\Filament\Pages;

use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Menchhub\FilamentSettings\MenchFilamentSettingsPlugin;
use Menchhub\FilamentSettings\Settings\SiteSettings;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;

class SiteSettingsPage extends SettingsPage
{
    protected static string $settings = SiteSettings::class;

    protected static ?string $slug = 'site-settings';

    public ?string $testEmailRecipient = null;

    protected static function getPlugin(): ?MenchFilamentSettingsPlugin
    {
        return Filament::getCurrentPanel()?->getPlugins()['filament-settings'] ?? null;
    }

    protected static ?string $navigationGroup = 'settings';
    public static function getNavigationGroup(): ?string
    {
        return __(static::$navigationGroup); // Make it translatable
    }

    public static function getNavigationLabel(): string
    {
        return static::getPlugin()?->getNavigationLabel() ?? 'Site Settings';
    }

    public static function getNavigationIcon(): ?string
    {
        return static::getPlugin()?->getIcon() ?? 'heroicon-o-cog';
    }

    public static function getNavigationSort(): ?int
    {
        return static::getPlugin()?->getSort() ?? 100;
    }

    public static function canAccess(): bool
    {
        return static::getPlugin()?->getCanAccess() ?? true;
    }

    public function getTitle(): string
    {
        return static::getPlugin()?->getTitle() ?? __('filament-settings::default.title');
    }


    public function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Settings')
                ->tabs([
                    // Tab 1: General Settings
                    Tabs\Tab::make('General')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Grid::make([
                            'sm' => 2,
                            'md' => 3,
                            'lg' => 4,
                            'xl' => 6,
                            '2xl' => 8,
                            ])
                            ->schema([
                                Section::make('General Information')
                                    ->columns([
                                        'sm' => 2,
                                    ])
                                    ->schema([
                                        TextInput::make('site_name')
                                            ->label('Site Name')
                                            ->columnSpan(2)
                                            ->required(),
                                        Textarea::make('site_description')
                                            ->label('Site Description')
                                            ->rows(4)
                                            ->columnSpan(2),
                                        TextInput::make('site_email')
                                            ->label('Site Email')
                                            ->email(),
                                        TextInput::make('site_url')
                                            ->label('Site URL')
                                            ->url(),
                                        ColorPicker::make('site_theme_light')
                                            ->label('Light Theme Color'),
                                        ColorPicker::make('site_theme_dark')
                                            ->label('Dark Theme Color'),

                                        TextInput::make('site_footer')
                                            ->label('Footer Message')
                                            ->columnSpan(2),

                                    ])->columnSpan(['sm' => 2, 'xl' => 4, '2xl' => 5]),

                                Section::make('Branding & Appearance')
                                    ->columns([
                                        'sm' => 1,
                                    ])
                                    ->schema([
                                        FileUpload::make('site_logo')
                                            ->label('Upload Site Logo')
                                            ->image()
                                            ->nullable()
                                            ->directory('assets') // File will be stored in 'storage/app/public/assets'
                                            ->visibility('public')
                                            ->disk('public')
                                            ->getUploadedFileNameForStorageUsing(fn($file) => $file->getClientOriginalName()), // Generate the correct file name
                                        FileUpload::make('site_favicon')
                                            ->label('Upload Favicon')
                                            ->image()
                                            ->directory('assets') // File will be stored in 'storage/app/public/assets'
                                            ->visibility('public')
                                            ->nullable()
                                            ->disk('public')
                                            ->getUploadedFileNameForStorageUsing(fn($file) => $file->getClientOriginalName()), // Generate the correct file name

                                    ])->columnSpan(['sm' => 2, 'xl' => 4, '2xl' => 3]),
                            ])
                        ]),

//                     Tab 2: SeoSettings
                    Tabs\Tab::make('SEO')
                        ->icon('heroicon-o-globe-alt')
                        ->schema([
                            Toggle::make('enable_seo')
                                ->label('Enable SEO')
                                ->reactive()
                                ->default(false),
                            Section::make('SEO Meta Info.')
                                ->schema([
                                    TextInput::make('meta_title')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_seo') === true)
                                        ->maxLength(60)
                                        ->extraAttributes([
                                            'x-data' => '{ text: $wire.entangle("meta_title").defer, maxLength: 160 }',
                                        ])
                                        ->hint(fn (callable $get) => new \Illuminate\Support\HtmlString('
                                            <div class="text-sm text-gray-600 mt-1">
                                                <span class="' . (strlen($get('meta_title')) > 60 ? 'text-red-500' : 'text-gray-800') . '">
                                                    ' . strlen($get('meta_title')) . '
                                                </span>
                                                / 160 characters
                                            </div>
                                        '))
                                        ->afterStateUpdated(function (callable $set, callable $get, $state) {
                                            // ✅ Limit text and show error
                                            if (strlen($state) > 60) {
                                                $set('errors.meta_title', 'The Meta Title must not exceed 60 characters.');
                                            } else {
                                                $set('errors.meta_title', null);
                                            }
                                        })
                                        ->required(),
                                    TextInput::make('meta_description')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_seo') === true)
                                        ->maxLength(160)
                                        ->extraAttributes([
                                            'x-data' => '{ text: $wire.entangle("meta_description").defer, maxLength: 160 }',
                                        ])
                                        ->hint(fn (callable $get) => new \Illuminate\Support\HtmlString('
                                            <div class="text-sm text-gray-600 mt-1">
                                                <span class="' . (strlen($get('meta_description')) > 160 ? 'text-red-500' : 'text-gray-800') . '">
                                                    ' . strlen($get('meta_description')) . '
                                                </span>
                                                / 160 characters
                                            </div>
                                        '))
                                        ->afterStateUpdated(function (callable $set, callable $get, $state) {
                                            // ✅ Limit text and show error
                                            if (strlen($state) > 160) {
                                                $set('errors.meta_description', 'The Meta Description must not exceed 160 characters.');
                                            } else {
                                                $set('errors.meta_description', null);
                                            }
                                        })
                                        ->required(),
                                    TextInput::make('meta_keywords')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_seo') === true)
                                        ->placeholder('keyword1, keyword2, keyword3')
                                        ->required(),
                                    TextInput::make('og_title')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_seo') === true)
                                        ->maxLength(60)
                                        ->required(),
                                    Textarea::make('og_description')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_seo') === true)
                                        ->rows(3)
                                        ->extraAttributes([
                                            'x-data' => '{ text: $wire.entangle("og_description").defer, maxLength: 160 }',
                                        ])
                                        ->hint(fn (callable $get) => new \Illuminate\Support\HtmlString('
                                            <div class="text-sm text-gray-600 mt-1">
                                                <span class="' . (strlen($get('og_description')) > 160 ? 'text-red-500' : 'text-gray-800') . '">
                                                    ' . strlen($get('og_description')) . '
                                                </span>
                                                / 160 characters
                                            </div>
                                        '))
                                        ->afterStateUpdated(function (callable $set, callable $get, $state) {
                                            // ✅ Limit text and show error
                                            if (strlen($state) > 160) {
                                                $set('errors.og_description', 'The Header Description must not exceed 160 characters.');
                                            } else {
                                                $set('errors.og_description', null);
                                            }
                                        })
                                        ->maxLength(160)
                                        ->required(),
                                    FileUpload::make('og_image')
                                        ->label('Open Graph Image')
                                        ->directory('seo-images')
                                        ->image()
                                        ->visibility('public')
                                        ->nullable(),
                                ])->columns(2),
                        ]),


//                     Tab 3: Email Settings
                    Tabs\Tab::make('Email')
                        ->icon('heroicon-o-envelope')
                        ->schema([

                            Toggle::make('enable_mail')
                                ->label('Enable Mail')
                                ->reactive()
                                ->default(false),

                            Section::make('Email Setup Info.')
                                ->schema([
                                    TextInput::make('mail_mailer')
                                        ->label('Mailer')
                                        ->placeholder('smtp')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_mail') === true)
                                        ->required(),

                                    TextInput::make('mail_host')
                                        ->label('Host')
                                        ->placeholder('smtp.mailtrap.io')
                                        ->visible(fn(callable $get) => $get('enable_mail') === true)
                                        ->required(),

                                    TextInput::make('mail_port')
                                        ->label('Port')
                                        ->placeholder('2525')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_mail') === true)
                                        ->numeric()
                                        ->required(),

                                    TextInput::make('mail_username')
                                        ->label('Username')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_mail') === true)
                                        ->required(),

                                    TextInput::make('mail_password')
                                        ->label('Password')
                                        ->password()
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_mail') === true),

                                    Select::make('mail_encryption')
                                        ->label('Encryption')
                                        ->options([
                                            'tls' => 'TLS',
                                            'ssl' => 'SSL',
                                            'none' => 'None',
                                        ])
                                        ->default('tls')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_mail') === true)
                                        ->required(),

                                    TextInput::make('mail_from_address')
                                        ->label('From Email Address')
                                        ->email()
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_mail') === true)
                                        ->required(),

                                    TextInput::make('mail_from_name')
                                        ->label('From Name')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_mail') === true)
                                        ->required(),

                                ])->columns(2),

                        ]),

//                     Tab 4: GoogleAnalytics Settings
                    Tabs\Tab::make('Google Analytics')
                        ->icon('heroicon-o-chart-bar')
                        ->schema([

                            Toggle::make('enable_gna')
                                ->label('Enable Google Analytics')
                                ->reactive()
                                ->default(false),
                            Section::make('Google Analytic Setup Info.')
                                ->schema([
                                    TextInput::make('tracking_id')->label('Tracking ID')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_gna') === true)
                                        ->placeholder('G-XXXXXXXXXX')
                                        ->required(),
//                                    TextInput::make('client_id')->label('Client ID')
//                                        ->reactive()
//                                        ->visible(fn(callable $get) => $get('enable_gna') === true)
//                                        ->required(),
//                                    TextInput::make('client_secret')->label('Client Secret')
//                                        ->reactive()
//                                        ->visible(fn(callable $get) => $get('enable_gna') === true)
//                                        ->required(),
//                                    TextInput::make('api_key')->label('API Key')
//                                        ->reactive()
//                                        ->visible(fn(callable $get) => $get('enable_gna') === true)
//                                        ->required(),
//                                    TextInput::make('view_id')->label('View ID')
//                                        ->reactive()
//                                        ->visible(fn(callable $get) => $get('enable_gna') === true)
//                                        ->required(),
                                ])->columns(2),

                        ]),


//                     Tab 5: Pusher Settings
                    Tabs\Tab::make('Pusher')
                        ->icon('heroicon-o-tv')
                        ->schema([

                            Toggle::make('enable_pusher')
                                ->label('Enable Pusher')
                                ->reactive()
                                ->default(false),
                            Section::make('Pusher Setup Info.')
                                ->schema([
                                    TextInput::make('app_id')
                                        ->label('App ID')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_pusher') === true)
                                        ->required(),
                                    TextInput::make('app_key')
                                        ->label('App Key')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_pusher') === true)
                                        ->required(),
                                    TextInput::make('app_secret')
                                        ->label('App Secret')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_pusher') === true)
                                        ->required(),
                                    TextInput::make('app_cluster')
                                        ->label('App Cluster')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_pusher') === true)
                                        ->required(),
                                ])->columns(2),

                        ]),


//                     Tab 6: Social Media Settings
                    Tabs\Tab::make('Social Media')
                        ->icon('heroicon-o-share')
                        ->schema([

                            Toggle::make('enable_sm')
                                ->label('Enable Social Media')
                                ->reactive()
                                ->default(false),
                            Section::make('Social Media Setup Info.')
                                ->schema([
                                    TextInput::make('facebook_url')->url()
                                        ->label('Facebook URL')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_sm') === true),
                                    TextInput::make('twitter_url')->url()
                                        ->label('Twitter URL')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_sm') === true),
                                    TextInput::make('instagram_url')->url()
                                        ->label('Instagram URL')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_sm') === true),
                                    TextInput::make('linkedin_url')->url()
                                        ->label('LinkedIn URL')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_sm') === true),
                                ])->columns(2),

                        ]),

                    //                     Tab 7: Login Page Settings
                    Tabs\Tab::make('Login Page')
                        ->icon('heroicon-o-computer-desktop')
                        ->schema([

                            Toggle::make('enable_lp')
                                ->label('Enable Login Theme')
                                ->reactive()
                                ->default(false),
                            Section::make('Login Theme Setup Info.')
                                ->schema([
                                    FileUpload::make('lp_bg_photo')
                                        ->label('Upload Background Photo')
                                        ->image()
                                        ->nullable()
                                        ->directory('assets') // File will be stored in 'storage/app/public/assets'
                                        ->visibility('public')
                                        ->disk('public')
                                        ->getUploadedFileNameForStorageUsing(fn($file) => $file->getClientOriginalName())
                                        ->visible(fn(callable $get) => $get('enable_lp') === true),
                                    TextInput::make('lp_title')
                                        ->label('Header Title')
                                        ->reactive()
                                        ->visible(fn(callable $get) => $get('enable_lp') === true),
                                    Textarea::make('lp_description')
                                        ->label('Header Description')
                                        ->reactive()
                                        ->visible(fn (callable $get) => $get('enable_lp') === true)
                                        ->rows(3)
                                        ->minLength(80)
                                        ->maxLength(160)
                                        ->extraAttributes([
                                            'x-data' => '{ text: $wire.entangle("lp_description").defer, maxLength: 160 }',
                                            ])
                                            ->hint(fn (callable $get) => new \Illuminate\Support\HtmlString('
                                            <div class="text-sm text-gray-600 mt-1">
                                                <span class="' . (strlen($get('lp_description')) > 160 ? 'text-red-500' : 'text-gray-800') . '">
                                                    ' . strlen($get('lp_description')) . '
                                                </span>
                                                / 160 characters
                                            </div>
                                        '))
                                        ->afterStateUpdated(function (callable $set, callable $get, $state) {
                                            // ✅ Limit text and show error
                                            if (strlen($state) > 160) {
                                                $set('errors.lp_description', 'The Header Description must not exceed 160 characters.');
                                            } else {
                                                $set('errors.lp_description', null);
                                            }
                                        }),


                                    ColorPicker::make('lp_login_bg_color')
                                        ->label('Login BG Color')
                                        ->visible(fn(callable $get) => $get('enable_lp') === true),
                                ])->columns(2),

                        ]),
                ])->columnSpan('full'),
        ]);
    }


    public function getActions(): array
    {
        return [
            // ✅ Action to Open Modal for Test Email
            \Filament\Actions\Action::make('sendTestEmail')
                ->label('Send Test Email')
                ->color('primary')
                ->icon('heroicon-o-paper-airplane')
                ->modalHeading('Enter Recipient Email')
                ->modalDescription('Enter an email address to receive a test email.')
                ->modalButton('Send Email')
                ->modalCancelActionLabel('Cancel')
                ->modalSubmitActionLabel('Send')
                ->form([
                    TextInput::make('testEmailRecipient')
                        ->label('Recipient Email')
                        ->email()
                        ->required()
                        ->placeholder('Enter recipient email')
                        ->live(), // Ensures value updates correctly
                ])
                ->action(fn(array $data) => $this->sendTestEmail($data['testEmailRecipient']))
                ->visible(fn() => app(\Menchhub\FilamentSettings\Settings\SiteSettings::class)->enable_mail),
        ];
    }

    public function sendTestEmail($recipient): void
    {
        $settings = app(SiteSettings::class);

        if (!$settings->enable_mail) {
            Notification::make()
                ->title('Email sending is disabled!')
                ->danger()
                ->send();
            return;
        }

        try {
            Mail::raw('This is a test email from Filament settings.', function ($message) use ($recipient) {
                $message->to($recipient)
                    ->subject('Test Email from Filament');
            });

            Notification::make()
                ->title('Test email sent successfully!')
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Failed to send test email!')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function afterSave(): void
    {
        // ✅ Refresh the entire page
        redirect(request()->header('Referer'));
    }


}
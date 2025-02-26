

# **Mench Hub Filament Settings Package**
A Filament v3 package that integrates **Spatie Laravel Settings** with Filament Admin Panel, allowing you to manage application settings easily.

---

## **📥 Installation**
Install the package via Composer:
```sh
composer require menchhub/filament-settings
```

Publish the configuration file:
```sh
php artisan vendor:publish --tag=filament-settings-config
```

Run the migration to create the settings table:
```sh
php artisan migrate
```

---

## **⚙️ Configuration**
After publishing the config file, you can find it in:  
📌 **`config/filament-settings.php`**

### **Example Config**
```php
return [
    /*
     * Available Filament settings pages to register.
     * These should extend `Filament\Pages\Page`.
     */
    'pages' => [
        \Menchhub\FilamentSettings\Filament\Pages\SiteSettingsPage::class,
    ],

    /*
     * Register the settings classes for Spatie Settings.
     * These should extend `Spatie\LaravelSettings\Settings`.
     */
    'settings' => [
        \Menchhub\FilamentSettings\Settings\SiteSettings::class,
    ],
];
```

### **🔹 How It Works**
- The package **automatically registers** settings pages defined in `config/filament-settings.php`.
- Any new settings pages added here **will be dynamically loaded** in Filament.

---

## **🏗️ Usage**
### **1️⃣ Add a New Settings Page**
Create a new **Filament settings page**:  
📌 **`app/Filament/Pages/CustomSettingsPage.php`**
```php
namespace App\Filament\Pages;

use Filament\Pages\SettingsPage;
use App\Settings\CustomSettings;

class CustomSettingsPage extends SettingsPage
{
    protected static ?string $navigationGroup = 'Settings';

    protected static string $settings = CustomSettings::class;

    protected static ?string $navigationLabel = 'Custom Settings';
}
```

### **2️⃣ Register the Page in `config/filament-settings.php`**
```php
'pages' => [
    \Menchhub\FilamentSettings\Filament\Pages\SiteSettingsPage::class,
    \App\Filament\Pages\CustomSettingsPage::class, // New settings page
],
```
✅ The **new page will automatically be available** in Filament **without modifying package code**.

---

## **🛠️ Extending the Package**
### **🔹 Custom Settings Class**
Create a new settings class using **Spatie Laravel Settings**:  
📌 **`app/Settings/CustomSettings.php`**
```php
namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CustomSettings extends Settings
{
    public string $custom_value;

    public static function group(): string
    {
        return 'custom-settings';
    }
}
```

### **🔹 Add to `config/filament-settings.php`**
```php
'settings' => [
    \Menchhub\FilamentSettings\Settings\SiteSettings::class,
    \App\Settings\CustomSettings::class, // New settings class
],
```
✅ Now Filament **automatically loads** the new settings!

---

## **✨ Features**
✅ **Fully integrates with Filament v3**  
✅ **Uses Spatie Laravel Settings for persistence**  
✅ **Automatically registers new settings pages**  
✅ **Easily configurable via `config/filament-settings.php`**

---

## **💡 Contributing**
Feel free to submit **issues, feature requests, or pull requests** to improve the package! 🚀

---

## **📄 License**
This package is open-sourced software licensed under the **MIT license**.



---
## 🏢 About Mench Hub
This package is maintained by [Menchhub](https://menchhub.com).  
For support, visit our [website](https://menchhub.com) or contact us at [support@menchhub.com](mailto:support@menchhub.com).


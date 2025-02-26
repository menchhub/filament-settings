Sure! Below is a **detailed `README-DEV.md`** for your internal development use. This file includes:

✅ **Development setup**  
✅ **Debugging tips**  
✅ **Testing instructions**  
✅ **Release checklist**  
✅ **Future improvements**

---

# **🚀 Developer Guide - Menchhub Filament Settings**
> **This file is for internal use only**. It contains **development, testing, and release** instructions.

---

## **📥 Local Development Setup**
### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/menchhub/filament-settings.git
cd filament-settings
```

### **2️⃣ Install Dependencies**
```sh
composer install
```

### **3️⃣ Run Migrations (If Needed)**
```sh
php artisan migrate
```

### **4️⃣ Symlink the Package for Local Testing**
If you're testing inside another Laravel project, link the package:
```sh
composer config repositories.local path /path/to/filament-settings
composer require menchhub/filament-settings:@dev
```
➡️ **Now changes in this repo will be reflected in your test project**.

---

## **🛠️ Debugging & Development Notes**
### **1️⃣ Check If Filament Plugin is Loaded**
Insert this inside `FilamentSettingsPlugin.php`:
```php
dd('Filament Settings Plugin is Loaded!');
```
Run Filament and check if the message appears.

### **2️⃣ Check Registered Settings Pages**
Inside `FilamentSettingsPlugin.php`, debug:
```php
dd(config('filament-settings.pages'));
```
➡️ This helps verify **if custom settings pages are correctly registered**.

### **3️⃣ Clear & Refresh Cache**
After making changes, clear Laravel caches:
```sh
php artisan cache:clear
php artisan config:clear
composer dump-autoload
```
➡️ **Ensures Filament and Spatie settings refresh properly**.

---

## **✅ Running Tests**
### **1️⃣ Run All Tests**
```sh
composer test
```

### **2️⃣ Run PHPUnit Manually**
```sh
vendor/bin/phpunit
```
➡️ **Ensure all tests pass before releasing!** 🚀

---

## **🚀 Release Checklist**
Before pushing a new release, follow this checklist:

### **1️⃣ Update & Test**
- [ ] Run **`composer test`** and ensure all tests pass.
- [ ] Test the package inside a Laravel app.
- [ ] Verify new settings pages register correctly.

### **2️⃣ Update Version Number**
📌 **File Path:** `composer.json`  
Increment the version:
```json
"version": "1.2.0"
```
Run:
```sh
composer update
```

### **3️⃣ Update `CHANGELOG.md`**
📌 **File Path:** `CHANGELOG.md`  
Add a new section for the version:
```md
## [1.2.0] - 2024-02-26
### Added
- New settings page registration method.
- Improved cache handling.

### Fixed
- Fixed issue with missing configuration.
```

### **4️⃣ Tag the Release**
Run:
```sh
git add .
git commit -m "Release v1.2.0"
git tag v1.2.0
git push origin --tags
```

### **5️⃣ Publish on Packagist**
Go to **[Packagist](https://packagist.org/)** and refresh the package.

---

## **📌 Future Improvements (TODOs)**
✅ **Planned Features & Enhancements**
- [ ] Add support for **custom settings UI components**.
- [ ] Improve **Filament settings cache handling**.
- [ ] Add more **unit tests** for Spatie settings.

---

## **📄 Notes**
- This file **is NOT included in the public package** (see `.gitattributes`).
- For support, contact **Menchhub developers**.

---
### **🛠️ Next Steps**
1. **Save this file as `README-DEV.md` in your repo.**
2. **Update `.gitattributes` to exclude it from Packagist.**
3. **Follow this guide when developing new features.**

🚀 **Now your package has a proper internal dev guide!** Let me know if you need adjustments! 😊🔥
<?php

namespace Menchhub\FilamentSettings;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Illuminate\Support\Facades\Config;
use Menchhub\FilamentSettings\Filament\Pages\SiteSettingsPage;
use Menchhub\FilamentSettings\Settings\SiteSettings;
use Menchhub\FilamentSettings\Theme\ThemeManager;

class MenchFilamentSettingsPlugin implements Plugin
{
    use EvaluatesClosures;

    protected Closure|bool $access = true;
    protected Closure|int $sort = 100;
    protected Closure|string $icon = '';
    protected Closure|string $navigationGroup = '';
    protected Closure|string $title = '';
    protected Closure|string $navigationLabel = '';

    public static function make(): static
    {
        return new static();
    }

    public function getId(): string
    {
        return 'filament-settings';
    }

    public function register(Panel $panel): void
    {
        $settings = app(SiteSettings::class);

        $panel->pages(Config::get('filament-settings.pages', []));

        ThemeManager::apply($panel);
    }

    public function boot(Panel $panel): void
    {
        //
    }


    // ✅ Keep your getters and setters (no changes needed below)
    public function setSort(Closure|int $value): static
    {
        $this->sort = $value;
        return $this;
    }

    public function getSort(): int
    {
        return $this->evaluate($this->sort);
    }

    public function setCanAccess(Closure|bool $value): static
    {
        $this->access = $value;
        return $this;
    }

    public function getCanAccess(): bool
    {
        return $this->evaluate($this->access);
    }

    public function setIcon(Closure|string $value): static
    {
        $this->icon = $value;
        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->evaluate($this->icon) ?? null;
    }

    public function setNavigationGroup(Closure|string $value): static
    {
        $this->navigationGroup = $value;
        return $this;
    }

    public function getNavigationGroup(): ?string
    {
        return $this->evaluate($this->navigationGroup) ?? null;
    }

    public function setTitle(Closure|string $value): static
    {
        $this->title = $value;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->evaluate($this->title) ?? null;
    }

    public function setNavigationLabel(Closure|string $value): static
    {
        $this->navigationLabel = $value;
        return $this;
    }

    public function getNavigationLabel(): ?string
    {
        return $this->evaluate($this->navigationLabel) ?? null;
    }


}

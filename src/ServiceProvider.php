<?php

namespace Nalletje\LivewireTables;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(): void
    {
        $this->loadLanguage();
        $this->loadViews();
        $this->publishConfig();
    }

    private function packagePath($path): string
    {
        return __DIR__ . "/../{$path}";
    }

    private function loadLanguage(): void
    {
        $this->loadTranslationsFrom($this->packagePath('resources/lang'), 'nalletje_livewiretables');
    }

    private function loadViews(): void
    {
        $viewsPath = $this->packagePath('resources/views');

        $this->loadViewsFrom($viewsPath, 'nalletje_livewiretables');

        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/nalletje_livewiretables'),
        ], 'views');
    }

    private function publishConfig(): void
    {
        $configPath = $this->packagePath('config/livewire-tables.php');

        $this->publishes([
            $configPath => config_path('livewire-tables.php'),
        ], 'config');

        $this->mergeConfigFrom($configPath, 'livewire-tables');
    }
}

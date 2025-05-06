<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigValidationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Валидация обязательных полей
        $requiredConfigs = [
            'shortlink.token',
            'shortlink.redirectNotFound',
            'shortlink.redirectInactive',
        ];

        foreach ($requiredConfigs as $configKey) {
            if (is_null(config($configKey))) {
                throw new \RuntimeException(
                    "Required configuration {$configKey} is not set in config"
                );
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }



    /**
     * Bootstrap services.
     */
    public function boot(Setting $setting): void
    {
        $sets = $setting->getSettings();

        $sets->map(function ($set){
            config([$set->key => $set->value]);
        });
    }
}

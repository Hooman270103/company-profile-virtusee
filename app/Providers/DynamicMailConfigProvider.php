<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class DynamicMailConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = Setting::first();
        if ($settings) {
            $config = [
                'driver' => $settings->mail_mailer,
                'host' => $settings->mail_host,
                'port' => (int)$settings->mail_port,
                'username' => $settings->mail_username,
                'password' => $settings->mail_password,
                'encryption' => $settings->mail_encryption,
                'from' => [
                    'address' => $settings->mail_from_addres,
                    'name' => $settings->mail_from_name,
                ],
            ];

            Config::set('mail', $config);
        }
    }
}

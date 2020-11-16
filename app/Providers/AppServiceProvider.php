<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

use App\Models\Setting;
use Config;

class AppServiceProvider extends ServiceProvider
{

    public static function findEnvSetting($name)
    {
        $env_settings = Setting::all()->toArray();
        foreach ($env_settings as $key => $value) {
            if ($value['name'] == $name) {
                return $value['val'];
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

        $this->app->bind('path.public', function() {
            return base_path().'/../public_html';
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::aliasComponent('components.backendBreadcrumbs', 'backendBreadcrumbs');

        // $settings = DB::table('settings')->all()->toArray();
        $smtp_host = $this->findEnvSetting('mail_host');
        $smtp_port = $this->findEnvSetting('mail_port');
        $smtp_username = $this->findEnvSetting('mail_username');
        $smtp_password = $this->findEnvSetting('mail_password');
        $smtp_encryption = $this->findEnvSetting('mail_encryption');


        $config = array(
            'driver'     => 'smtp',
            'host'       => $smtp_host,
            'port'       => $smtp_port,
            'encryption' => $smtp_encryption,
            'username'   => $smtp_username,
            'password'   => $smtp_password,
            'pretend'    => false,
        );
        Config::set('mail', $config);

        // dd($smtp_host);
    }
}

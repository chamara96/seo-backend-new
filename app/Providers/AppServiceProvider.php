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

        // Schema::defaultStringLength(191);
        //$this->app->bind('path.public', function () {
        //    return base_path() . '/../blog.chamaralabs.com';
        //});
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


        $config = array(
            'driver'     => 'smtp',
            'host'       => $smtp_host,
            'port'       => $smtp_port,
            // 'from'       => array('address' => $mail->from_address, 'name' => $mail->from_name),
            // 'encryption' => 'TLS',//2020-09-11
            'encryption' => 'ssl',
            'username'   => $smtp_username,
            'password'   => $smtp_password,
            // 'sendmail'   => '/usr/sbin/sendmail -bs',
            'pretend'    => false,
        );
        Config::set('mail', $config);

        // dd($smtp_host);
    }
}

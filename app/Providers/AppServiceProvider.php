<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Bridge\Brevo\Transport\BrevoTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') !== 'local' || isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Register Brevo (Sendinblue) as custom mail transport
        Mail::extend('brevo', function (array $config) {
            $factory = new BrevoTransportFactory();
            $key = $config['key'] ?? config('services.brevo.key');

            return $factory->create(new Dsn(
                'brevo+api',
                'default',
                $key
            ));
        });
    }
}

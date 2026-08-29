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
        // Auto-expire pending bookings older than 30 minutes without needing a Cron job
        // It runs once per minute on any request to keep the database clean
        if (!$this->app->runningInConsole() && !\Illuminate\Support\Facades\Cache::has('booking_cleanup')) {
            try {
                \App\Models\Booking::where('status', 'pending')
                    ->where('created_at', '<', now()->subMinutes(30))
                    ->update(['status' => 'failed']);
                \Illuminate\Support\Facades\Cache::put('booking_cleanup', true, 60); // cache for 60 seconds
            } catch (\Exception $e) {
                // Ignore DB errors during initial setup/migration
            }
        }
    }
}

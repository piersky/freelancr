<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use App\Settings;

class AppServiceProvider extends ServiceProvider
{
    public $settings;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->settings = $this->app->singleton(Settings::class, function () {
            return Settings::make(storage_path('app/settings.json'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('money', function ($amount) {
            return "<?php echo '€ ' . number_format($amount, 2, ',', '.'); ?>";
        });

        Blade::directive('date_eu', function ($date) {
            return "<?= date('d/m/Y', strtotime($date)); ?>";
        });

        Paginator::useBootstrap();
    }
}

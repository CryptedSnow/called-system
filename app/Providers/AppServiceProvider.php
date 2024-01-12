<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();

        Blade::directive('dinheiro', function ($expression) {
            return "<?php echo 'R$' . number_format($expression, 2, ',', '.'); ?>";
        });

        Blade::directive('peso', function ($expression) {
            return "<?php echo number_format($expression, 2, ',', '.') . ' kg'; ?>";
        });

        Blade::directive('altura', function ($expression) {
            return "<?php echo number_format($expression, 2, ',', '.') . ' cm'; ?>";
        });
    }
}

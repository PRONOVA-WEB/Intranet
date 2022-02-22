<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
        Blade::directive('active', function ($route) {
            //$route = array('home','login');
            if (is_array($route)) {
                return in_array(request()->is(), $route) ? 'active' : '';
            }
            return request()->is($route) ? 'active' : '';
        });


        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)?($expression)->format('Y-m-d H:i:s'):''; ?>";
        });

        /* Helper para imprimir un número con separador de miles */
        Blade::directive('numero', function ($numero) {
            return "<?php echo number_format($numero, 0, '.', '.'); ?>";
        });

        Paginator::useBootstrap();

        if (! app()->environment('production')) {
            Mail::alwaysTo('foo@example.org');
        }
    }
}

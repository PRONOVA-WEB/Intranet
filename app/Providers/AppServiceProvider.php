<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

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

        Blade::directive('settings', function ($key) {
            $setting = optional(\App\Models\Setting::where('key', $key)->first());
            if ($setting->value) {
                $valor = $setting->value;
                if ($setting->type == 'image' && \File::exists('storage/' . $setting->value)) {
                    $valor = \Storage::url($setting->value);
                }
                return $valor;
            } else {
                return null;
            }
        });

        Paginator::useBootstrap();
    }
}

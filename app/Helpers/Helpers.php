<?php

/* Set active route */
function active($route_name)
{
    echo request()->routeIs($route_name) ? 'active' : '';
}

function money($value)
{
    echo number_format($value, 0, '', '.');
}

function trashed($user)
{
    if ($user->trashed())
        echo '<i class="fas fa-user-slash" title="Usuario eliminado"></i>';
}

if (!function_exists('settings')) {
    function settings($key = null)
    {
        $setting = optional(\App\Models\Setting::where('key', $key)->first());
        if ($setting->value) {
            $valor = $setting->value;
            if ($setting->type == 'image' && \Storage::disk('public')->exists($setting->value)) {
                $valor = \Storage::disk('public')->url($setting->value);
            }
            return $valor;
        } else {
            return null;
        }
    }

    function ceros($value) {
        switch ((strlen($value))) {
            case '1':
                $ceros = '0000';
                break;
            case '2':
                $ceros = '000';
                break;
            case '3':
                $ceros = '00';
                break;
            case '4':
                $ceros = '0';
                break;
        }
        return $ceros.$value;
    }
}

function dateCustomFormat($date)
{
    return \Carbon\Carbon::parse($date)->format('d-m-Y');
}

function dateCustomFormatHms($date)
{
    return \Carbon\Carbon::parse($date)->format('d-m-Y h:i:s');
}

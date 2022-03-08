<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="author" content="{{ env('APP_SS') }}">
        <link href="{{ asset('css/report.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="content">
            <img style="padding-bottom: 4px;" src="{{ asset('images/logo_pronova.jpg') }}"
                width="120" alt="Logo {{ settings('site.organization') }}"><br>
            @yield('content')

            <div class="pie_pagina seis center">
                <span class="uppercase">{{ settings('site.organization') }}</span><br>
                Fono: {{ settings('site.phone') }} -
                {{ env('APP_URL') }}
            </div>
        </div>

        @yield('custom_js')
    </body>
</html>

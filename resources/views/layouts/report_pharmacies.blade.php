<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="author" content="{{ settings('site.organization') }}">
        <link href="{{ asset('css/report.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="content">
<<<<<<< HEAD
        <img style="padding-bottom: 4px;" src="{{ settings('site.logo') }}"
            width="120" alt="Logo {{ settings('site.organization') }}"><br>
=======
          @if( Auth::user()->pharmacies->first()->id == 2)
            <img style="padding-bottom: 4px;" src="{{ asset('images/logo_cgu_pluma.jpg') }}"
              width="120" alt="Logo {{ env('APP_SS') }}"><br>
          @else
            <img style="padding-bottom: 4px;" src="{{ asset('images/logo_pluma.jpg') }}"
                width="120" alt="Logo {{ env('APP_SS') }}"><br>
          @endif
>>>>>>> ebee989a8d9556bf2aeea9c2144eaf6c0c0197e7

          @yield('content')

          <div class="pie_pagina seis center">
              <span class="uppercase">{{ settings('site.organization') }}</span><br>
              {{ settings('site.phone') }}
          </div>
        </div>

        @yield('custom_js')
    </body>
</html>

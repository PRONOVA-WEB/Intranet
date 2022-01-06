<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>{{ env('APP_NAME') }}</title>
    <meta content="Pronova" name="author" />
    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/intranet.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7c4f606aba.js" SameSite="None" crossorigin="anonymous"></script>
    <link href="{{ asset('css/cu.min.css') }}" rel="stylesheet">
    <style>
        .locallogin {
            background-color: #e7e7e7;
            color: black;
            border: none;
            padding: 9px 26px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

        .bg-gradient-primary {
            @switch(env('APP_ENV')) @case('local') background-color: rgb(109, 108, 108 ); @break @case('testing') background-color: rgb(2, 82, 0); @break @case('production')@if (env('APP_DEBUG') == true)background-color: rgb(255, 0, 0);
            @endif@break;
            @endswitch background-image: none;
        }

    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 offset-3 d-none d-lg-block" id="login_botones">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{ env('APP_NAME') }}</h1>
                                        <img src="{{ asset('images/logo_pronova.jpg') }}" class="img-fluid">
                                    </div>
                                    <div class="row justify-content-center d-block mt-5">
                                        <a class="btn-cu btn-l btn-fw btn-color-estandar"
                                        href="{{ route('claveunica.autenticar') }}?redirect=L2NsYXZldW5pY2EvbG9naW4="
                                        title="Este es el botón Iniciar sesión de ClaveÚnica">
                                        <span class="cl-claveunica"></span>
                                        <span class="texto">Iniciar sesión</span>
                                        </a>
                                        <hr>
                                        <button type="button" class="btn-user
                                        btn-block locallogin" id="show_local_login">
                                            <i class="fas fa-lg fa-sign-in-alt"></i>
                                            <u class="ml-1">Iniciar local</u>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-none p-5" id="local_login">
                                <h1 class="h4 text-gray-900 mb-4 text-center">{{ __('Sing In').' sin clave única' }}</h1>
                                <form method="POST"  action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="id">{{ __('RUN') }}</label>
                                        <div class="col-md-12">
                                            <input id="id" type="text"
                                                class="identificacion form-control form-control-user @error('id') is-invalid @enderror" name="id"
                                                value="{{ old('id') }}" required autofocus>

                                            @error('id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">{{ __('Clave') }}</label>
                                        <div class="col-md-12">
                                            <input id="password" type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Recordarme') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Sing In') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Recordar Clave') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <!-- Custom scripts-->
    <script type="text/javascript">
        $("#show_local_login").click(function() {
            $("#local_login").toggleClass('d-none');
            $("#login_botones").toggleClass('offset-3');
        });
        $('.identificacion').mask('00000000-A', {
            onKeyPress: function (value, event) {
                event.currentTarget.value = value.toUpperCase();
        }});
    </script>
</body>

</html>

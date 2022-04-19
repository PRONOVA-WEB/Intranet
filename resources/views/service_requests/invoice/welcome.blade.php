@extends('layouts.guest')

@section('title', 'Información sobre funcionarios a Honorarios')

@section('content')

<div class="container-fluid">
    <h3 class="mb-3">Información para funcionarios a honorarios</h3>
    <ul>
        <li>Está dirigido a funcionarios que poseen contrato a Honorario</li>
        <li>Podrás ver el estado de tus solicitudes de pago</li>
    </ul>
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0 shadow-lg">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 d-lg-none d-lg-block" id="login_botones">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="text-gray-900 mb-2">{{ settings('site.title') }}</h1>
                                    <img src="{{ settings('site.logo') }}" class="img-fluid">
                                </div>
                                <div class="row justify-content-center d-block mt-5">
                                    @isset($url)
                                        <a class="btn-cu btn-l btn-fw btn-color-estandar"
                                        href="{{ route('claveunica.autenticar') }}?redirect=L2NsYXZldW5pY2EvbG9naW4tZXh0ZXJuYWw="
                                        title="Este es el botón Iniciar sesión de ClaveÚnica">
                                    @else
                                        <a class="btn-cu btn-l btn-fw btn-color-estandar"
                                        href="{{ route('claveunica.autenticar') }}?redirect=L2NsYXZldW5pY2EvbG9naW4="
                                        title="Este es el botón Iniciar sesión de ClaveÚnica">
                                    @endif
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
                        <div class="col-lg-6 d-none px-5 py-lg-5 py-5" id="local_login">
                            <h1 class="h4 text-gray-900 mb-4 text-center">{{ __('Sing In').' sin clave única' }}</h1>
                            <form method="POST" action="{{ route('invoice.login') }}">
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
                                        <button id="toggle-password" type="button" class="d-none"
                                            aria-label="Show password as plain text. Warning: this will display your password on the screen.">
                                        </button>
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

@section('custom_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="{{ asset('js/show-password-toggle.min.js') }}" async></script>
<!-- Custom scripts-->
<script type="text/javascript">
    @if ($errors->any())
        $("#login_botones").toggleClass('offset-lg-3');
        $("#local_login").toggleClass('d-none');
    @endif
    $("#show_local_login").click(function() {
        $("#local_login").toggleClass('d-none');
        $("#login_botones").toggleClass('offset-lg-3');
    });
    $('.identificacion').mask('00000000-A', {
        onKeyPress: function (value, event) {
            event.currentTarget.value = value.toUpperCase();
    }});
</script>
@endsection

@endsection

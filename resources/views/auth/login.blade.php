@extends('layouts.signin')

@section('content')
    <div class="container border">
        <form method="POST" action="{{ route('login') }}" class="form-signin">
            @csrf
            <input type="hidden" name="g-recaptcha-response">
            <img src="{{asset('tai-chi.png')}}" class="mb-1" width="120">
            <h1 class="h3 my-3 font-weight-normal">{{__('Please sign in')}}</h1>
            <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label for="password" class="sr-only">{{ __('Password') }}</label>
            <input id="password" type="password" class="mt-3 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <button type="submit" class="btn btn-lg btn-primary btn-block mt-2">
                {{ __('Login') }}
            </button>
            @if (Route::has('password.request'))
                <p class="mb-1 text-muted"></p><a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a></form>
        @endif
        <p class="my-3 text-muted">&copy; 2020 <a href="https://pierluigipapeschi.com">Pier Luigi Papeschi</a></p>
        </form>
    </div>
    <script src="https://www.google.com/recaptcha/api.js?render={{config('app.site_key')}}"></script>
    <script>
        let siteKey = "{{config('app.site_key')}}"
        grecaptcha.ready(function() {
            grecaptcha.execute(siteKey, {action: 'login'})
                .then(function (token) {
                    document.querySelector('input[name=g-recaptcha-response]').value = token
                })
        })
    </script>
@endsection

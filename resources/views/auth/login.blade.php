<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" >
</head>
<body class="">
<div class="page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-6">
                        <img src="./assets/brand/tabler.svg" class="h-6" alt="">
                    </div>
                    <form class="card" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card-body p-6">
                            <div class="card-title">{{ __('Login') }}</div>
                            <div class="form-group">
                                <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">

                                <label class="form-label" for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" name="password"  class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">

                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="custom-control-label">{{ __('Remember Me') }}</span>
                                </label>
                            </div>
                            <div class="form-footer">

                                <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
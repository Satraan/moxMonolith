<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->



</head>

@extends('layouts.app')

@section('content')

<div class="page--login">
    <div class="ui container">
        <div class="ui two column grid">
            <div class="ui eight wide column">
                <div class="ui fluid card">

                    <form method="POST" action="{{ route('login') }}"class="ui form">
                        @csrf
                        <h4 class="ui dividing center aligned header">{{ __('Login') }}</h4>
                        <div class="field">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>



                        <div class="field">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>



                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="ui button">
                                {{ __('Login') }}
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>


            <div class="ui eight wide column">
            <div class="ui fluid card">

                <form method="POST" action="{{ route('register') }}" class="ui form">
                    @csrf
                    <h4 class="ui dividing center aligned header">{{ __('Register') }}</h4>


                    <div class="field">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="field">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="field">
                        <label for="password">{{ __('Password') }}</label>

                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="field">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>


                    <button type="submit" class="ui button">
                        {{ __('Register') }}
                    </button>

                </form>

            </div>
            </div>
        </div>


    </div>
    </div>

</div>
@endsection

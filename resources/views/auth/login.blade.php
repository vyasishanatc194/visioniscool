
@extends('layouts.auth')
@section('content')
    <!--Login Page Starts-->
    <section id="login" class="auth-height">
        <div class="row full-height-vh m-0">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="card overflow-hidden">
                    <div class="card-content">
                        <div class="card-body auth-img">
                            <div class="row m-0">
                                <div
                                    class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center auth-img-bg p-3">
                                    <img src="{{ asset('app-assets/img/gallery/login.png')}}" alt="" class="img-fluid" width="300" height="230">
                                </div>
                                <div class="col-lg-6 col-12 px-4 py-3">
                                    <form method="POST" action="{{ url('sign-in') }}">
                                        @csrf
                                        <h4 class="mb-2 card-title">Login</h4>
                                        <p>Welcome back, please login to your account.</p>
                                        <input id="email" type="email" class="form-control mb-3 @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <input id="password" type="password" class="form-control mb-2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        {{-- <div class="d-sm-flex justify-content-between mb-3 font-small-2">
                                            <div class="remember-me mb-2 mb-sm-0">
                                                <div class="checkbox auth-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="auth-ligin"><span>Remember Me</span></label>
                                                </div>
                                            </div>
                                            @if (Route::has('password.request'))
                                            <a  href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                            @endif
                                        </div> --}}
                                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>
                                            
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Login Page Ends-->
@endsection
{{-- @extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('sign-in') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
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
@endsection --}}

@extends('layouts.app')

@section('content')
    <section class="vh-100" style="background-color: #343b69;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                                     alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0">Ai-Moon</span>
                                        </div>
                                        <br>
                                        <div class="form-outline mb-4">
                                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('messages.Email Address') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('messages.Password') }}</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-dark btn-lg btn-block">
                                                    {{ __('messages.Login') }}
                                                </button>
                                            </div>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a class="small text-muted" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                        @endif

                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">{{__('messages.Dont have an account')}}? <a href="{{ route('register.form') }}"
                                                                                                                  style="color: #393f81;">{{__('messages.Register')}}</a></p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

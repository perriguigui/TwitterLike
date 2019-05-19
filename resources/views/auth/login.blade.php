@extends('layout')

@section('content')
<div class="container">


    <div class="row justify-content-center ">
        <div class=" col-md-12 " >
            <div class="card loginCard mx-md-auto mx-sm-0 " style="width: 70rem;"  >

                <div class="card-header cardHeaderStyle mx-auto px-5 mt-2 mb-5 border-bottom border-danger rounded" >{{ __('Login') }}</div>

                <div class="card-body ">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6 mx-auto mt-1 mb-lg-3 mb-md-2">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 mx-auto">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"placeholder="Enter password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3 offset-sm-0 mt-4">
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label ml-4" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-2 ">
                            <div class="col-8 offset-lg-3 offset-md-3 offset-sm-0 mt-3">
                                <button type="submit" class="btn btn-light btnstyle-1">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link " href="{{ route('password.request') }}">
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
</div>
@endsection

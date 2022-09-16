@extends('layouts.login')

@section('content')
<style>
    #wrapper .main {
        width: 100% !important;
        padding-top: 40px !important;
    }
    .card {
        background: white;
        padding: 30px;
        box-shadow: 0 8px 6px -6px #959595;
    }
</style>
<div class="">
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4 text-center">
                    <div class="row mb-5">
                        <div class="col-xs-6">
                            <img style="width: 100%;" src="{{asset('images/login/02.png')}}">
                        </div>
                        <div class="col-xs-6 vl">
                            <img style="width: 80%;" src="{{asset('images/login/01.png')}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mdn" style="margin: 100px auto;">
                    <P class="text-center p-side">CREATE, MANAGE,<br><span style="font-size: 5rem; position: relative; bottom: 15px;">GET DISCOVERED</span></P>
                </div>
                <div class="col-md-4">
                    <h1 class="text-center h-logo">BRANDS</h1>
                    <div class="card" style="margin: 0 30px;">
                        <div class="card-body m-3">
                            <form method="POST" action="{{ route('authenticate') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-dark">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mdn" style="margin: 100px auto;">
                    <P class="text-center p-side"><span style="position: relative; bottom: 15px">THE MOST MODERN AND </span><br>
                        <span style="position: relative; bottom: 20px;">EFFICIENT WAY TO GROW</span><br>
                        <span style="position: relative; bottom: 30px;">YOUR CONNABIS COMPANY</span>
                    </P>
                </div>
            </div>
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-4">
                <img style="width:100%;padding:65px;" src="{{asset('images/login/BOTTOM ICONS.png')}}">
        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>
@endsection

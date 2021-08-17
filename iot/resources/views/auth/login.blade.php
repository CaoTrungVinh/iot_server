@extends('auth.auth')
@section('content-auth')

    <div class="login-box">
        <h1 class="text-center mb-5" style="margin-bottom: 10px !important;">
            <img src="assets/img/logo.png" class="" style="width: 60px; height: 60px;"/>
{{--            <i class="fa fa-rocket text-primary"></i>--}}
            Quản lý hệ thống</h1>
        <div class="column">
            <div class="login-box-form" style="width: 400px; text-align: center; margin: auto">
                <p class="form" style="color: red; font-size: 15px!important;">
                    @error('changePass')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </p>
                <h3 class="mb-2" style="margin-bottom: 20px!important;">Đăng nhập</h3>
                <form method="post" action="{{route('postAdLogin')}}" class="mt-2">
                    @csrf
                    @error('mes')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror

                    @if(Session::has('ok'))
                        <small class="form-text text-success">{{ Session::get('ok') }}</small>
                    @endif
                    <p class="form">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control mt-0" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email" id="email" value="{{ old('email') }}" />
                    </div>
                    @error('email')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    </p>

                    <p class="form">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control mt-0" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="pass" id="pass" />
                    </div>
                    @error('pass')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    </p>

                    <div class="form-group">
                        <input type="submit" class="btn btn-theme btn-block p-2 mb-1" name="login" value="Đăng nhập" />
                        <a href="{{route('AdForgotPass')}}">
                            <small class="text-theme" style="font-style: italic; text-align: center"><strong>Quên mật khẩu?</strong></small>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection()

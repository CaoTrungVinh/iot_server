@extends('auth.auth')
@section('content-auth')
<div class="login-box">
    <h1 class="text-center mb-5" style="margin-bottom: 10px !important;">
        <img src="assets/img/logo.png" class="" style="width: 60px; height: 60px;"/>
        Quản lý hệ thống</h1>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-12 login-box-form p-4" style="width: 400px; text-align: center; margin: auto">
            <h3 class="mb-4">Quên mật khẩu</h3>
            <form method="post" action="{{route('postAdForgotPass')}}" class="mt-2">
                @csrf
                @error('mes')
                <small class="form-text text-danger" style="font-size: 15px">{{ $message }}</small>
                @enderror

                @if(Session::has('ok'))
                    <small class="form-text text-success">{{ Session::get('ok') }}</small>
                @endif
                <p class="form">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input type="text" class="form-control mt-0" placeholder="Email address" aria-label="enail" aria-describedby="basic-addon1" name="email" id="email" value="{{ old('email') }}" />
                </div>
                @error('email')
                <small class="form-text text-danger" style=" margin-bottom: 20px; margin-top: -10px; font-size: 15px;">{{ $message }}</small>
                @enderror
                </p>

                <p class="form">
                <div class="form-group">
                    <input type="submit" class="btn btn-theme btn-block p-2 mb-1" name="sendMail" value="Gửi"  />
                    <a href="{{route('adLogin')}}">
                        <small class="text-theme" style="font-style: italic"><strong>Trở về trang đăng nhập</strong></small>
                    </a>
                </div>
                @error('sendMail')
                <small class="form-text text-danger" style="font-size: 15px">{{ $message }}</small>
                @enderror
                </p>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('auth.auth')
@section('content-auth')
    <div class="login-box">
        <h1 class="text-center mb-5" style="margin-bottom: 10px !important;">
            <img src="assets/img/logo.png" class="" style="width: 60px; height: 60px;"/>
            {{--            <i class="fa fa-rocket text-primary"></i>--}}
            Hệ thống giám sát ao nuôi</h1>
        <div class="column">
            <div class="login-box-form" style="padding: 15px 25px 0.5px 25px!important;">
                <p class="form" style="color: red; font-size: 15px!important;">
                    @error('changePass')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </p>
                <h3 class="mb-2" style="margin-bottom: 20px!important; text-align: center">Đăng ký tài khoản</h3>

                {{--          form Register         --}}
                <form method="post" action="{{route('postRegister')}}" class="form-horizontal mt-4 mb-5" style="margin-top: 0px!important;">
                    @csrf
                    <div class="form-group row" style="margin-bottom: 0px">
                        <div class="col-sm-6">
                            <p class="form">
                                <label class="control-label" for="input-1">Họ tên</label>
                                <input type="text" class="form-control" id="input-1" name="r_userName" value="{{old('r_userName')}}" />
                                @error('r_userName')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="form">
                                <label class="control-label" for="input-2">Địa chỉ email</label>
                                <input type="text" class="form-control" id="input-2" name="r_email" value="{{old('r_email')}}"/>
                                @error('r_email')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </p>
                        </div>
                    </div>

                    <div class="form-group row" style="margin-bottom: 0px">
                        <div class="col-sm-6">
                            <p class="form">
                                <label class="control-label" for="input-1">Mật khẩu đăng nhập</label>
                                <input type="password" class="form-control" aria-label="Password" aria-describedby="basic-addon1" id="input-1" name="r_pass" />
                                @error('r_pass')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="form">
                                <label class="control-label" for="input-1">Xác nhận mật khẩu</label>
                                <input type="password" class="form-control" aria-label="Repeat Password" aria-describedby="basic-addon1" id="input-1" name="re_pass" />
                                @error('re_pass')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </p>
                        </div>
                    </div>

                    <div class="form-group row" style="margin-bottom: 0px">
                        <div class="col-sm-6">
                            <p class="form">
                                <label class="control-label" for="input-3">Ngày sinh</label>
                                <input type="date" class="form-control" id="input-3" name="r_birthday" value="{{old('r_birthday')}}"/>
                                @error('r_birthday')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="form">
                                <label class="control-label" for="exampleFormControlSelect1">Giới tính</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="r_gender">
                                    <option value="">Chọn...</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="khác">Khác</option>
                                </select>
                                @error('r_gender')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </p>
                        </div>
                    </div>

                    <div class="form-group row" style="margin-bottom: 0px">
                        <div class="col-sm-6">
                            <p class="form">
                                <label class="control-label" for="input-4">Số điện thoại</label>
                                <input type="number" maxlength="5" class="form-control" id="input-4" name="r_phone" value="{{old('r_phone')}}"/>
                                @error('r_phone')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="form">
                                <label class="control-label" for="input-5">Địa chỉ</label>
                                <input type="text" class="form-control" id="input-5" name="r_address" value="{{old('r_address')}}"/>
                                @error('r_address')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </p>
                        </div>
                    </div>

                    <div class="form-group row" style="margin-top: 40px">
                        <p class="form">
                        <div class="col-sm-6">
                            <a href="{{route('homeUs')}}" class="col-sm-12 btn btn-danger">Đăng nhập</a>
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" class="col-sm-12 btn btn-theme" name="register" value="Đăng ký"/>
                        </div>
                        @error('register')
                        <small class="form-text text-danger" style="margin-top: 15px; font-size: 18px; margin-left: 15px">{{ $message }}</small>
                        @enderror
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

<!-- Script to active register
    ================================================== -->
@section('lastScript')
    @if ($register ?? ''!='')
        <script>
            $( document ).ready(function() {
                $('.tabs-nav a[href$="{{$register}}"]').parent("li").click();
            });
        </script>
    @endif
@endsection()

@extends('layout.indexUser')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
            <!--User profile content-->
            <div class="col-sm-12 col-md-8" style="flex:0 0 100%; max-width: 100%">
                <div class="login-box-form" style="width: 100%; text-align: center; margin: auto">
                    <h3>Đổi mật khẩu</h3>
                    <form method="post" action="{{route('userpostChangePass')}}" class="mt-2" style="width: 50%; display: inline-block">
                        @csrf
                        @error('mes')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror

                        <p class="form">
                        <div class="input-group mb-3" style="margin-bottom: 2rem!important">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock"></i></span>
                            </div>
                            <input type="password" class="form-control mt-0" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="cur_pass" id="cur_pass" />
                        </div>
                        @error('cur_pass')
                        <small class="form-text text-danger" style="margin-top: -25px; margin-bottom: 25px;">{{ $message }}</small>
                        @enderror
                        </p>

                        <p class="form">
                        <div class="input-group mb-3" style="margin-bottom: 2rem!important">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control mt-0" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="new_pass" id="new_pass" />
                        </div>
                        @error('new_pass')
                        <small class="form-text text-danger" style="margin-top: -25px; margin-bottom: 25px;">{{ $message }}</small>
                        @enderror
                        </p>

                        <p class="form">
                        <div class="input-group mb-3" style="margin-bottom: 2rem!important">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control mt-0" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="confirm_pass" id="confirm_pass" />
                        </div>
                        @error('confirm_pass')
                        <small class="form-text text-danger" style="margin-top: -25px; margin-bottom: 25px;">{{ $message }}</small>
                        @enderror
                        </p>

                        <div class="form-group">
                            <input type="submit" class="btn btn-theme btn-block p-2 mb-1" name="changePass" value="Xác nhận đổi mật khẩu" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


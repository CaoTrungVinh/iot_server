@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-0"><strong>Tạo tài khoản</strong></h5>
        <span class="text-secondary">Trang chủ <i class="fa fa-angle-right"></i> Tài khoản <i
                class="fa fa-angle-right"></i> Thêm tài khoản</span>

        <?php //Hiển thị thông báo thành công?>

        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong style="color: blue">{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif

        <?php //Hiển thị thông báo lỗi?>
        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong style="color:red;">{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif

        <div class="row mt-3">
            <div class="col-sm-12 col-md-8" style="flex:0 0 100%; max-width: 100%">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm custom-tabs">

                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-customContent" role="tablist">
                            <a class="nav-item nav-link active" id="nav-profile" data-toggle="tab"
                               href="#custom-profile"
                               role="tab" aria-controls="nav-profile" aria-selected="false">
                                <i class="fas fa-user"></i> Tài khoản người dùng
                            </a>
                            <a class="nav-item nav-link" id="nav-contact" data-toggle="tab" href="#custom-contact"
                               role="tab" aria-controls="nav-contact" aria-selected="false">
                                <i class="fas fa-user-tie"></i> Tài khoản người quản trị
                            </a>
                        </div>
                    </nav>

                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-customContent">
                        <!--Tạo tài khoản người dùng-->
                        <div class="tab-pane fade show active p-4" id="custom-profile" role="tabpanel"
                             aria-labelledby="nav-profile">
                            <form method="post" action="{{route('store_user')}}" class="form-horizontal mt-4 mb-5" style="margin-top: 0px!important;">
                                @csrf
                                <div class="form-group row">
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

                                <div class="form-group row">
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

                                <div class="form-group row">
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
                                        <a href="{{route('user')}}" class="col-sm-12 btn btn-danger">Hủy</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="submit" class="col-sm-12 btn btn-theme" name="create" value="Tạo mới"/>
                                    </div>
                                    @error('create')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                    </p>
                                </div>
                            </form>
                        </div>
                        <!--/tạo tài khoản người dùng-->

                        <!--Resume tab_Tại tài khoản admin-->
                        <div class="tab-pane fade p-4" id="custom-contact" role="tabpanel"
                             aria-labelledby="nav-contact">
                            <form method="post" action="{{route('store_admin')}}" class="form-horizontal mt-4 mb-5" style="margin-top: 0px!important;">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <p class="form">
                                            <label class="control-label" for="input-1">Họ tên</label>
                                            <input type="text" class="form-control" id="input-1" name="ad_userName" value="{{old('ad_userName')}}" />
                                            @error('ad_userName')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="form">
                                            <label class="control-label" for="input-2">Địa chỉ email</label>
                                            <input type="text" class="form-control" id="input-2" name="ad_email" value="{{old('ad_email')}}"/>
                                            @error('ad_email')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <p class="form">
                                            <label class="control-label" for="input-1">Mật khẩu đăng nhập</label>
                                            <input type="password" class="form-control" aria-label="Password" aria-describedby="basic-addon1" id="input-1" name="ad_pass" />
                                            @error('ad_pass')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="form">
                                            <label class="control-label" for="input-1">Xác nhận mật khẩu</label>
                                            <input type="password" class="form-control" aria-label="Repeat Password" aria-describedby="basic-addon1" id="input-1" name="read_pass" />
                                            @error('read_pass')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 40px">
                                    <p class="form">
                                    <div class="col-sm-6">
                                        <a href="{{route('user')}}" class="col-sm-12 btn btn-danger">Hủy</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="submit" class="col-sm-12 btn btn-theme" name="ad_create" value="Tạo mới"/>
                                    </div>
                                    @error('ad_create')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                    </p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

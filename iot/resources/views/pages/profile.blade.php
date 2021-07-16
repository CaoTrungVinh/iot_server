@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-0"><strong>Thông tin tài khoản</strong></h5>
        <span class="text-secondary"> Trang chủ <i class="fa fa-angle-right"></i> Thông tin tài khoản </span>
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
            <!--User profile content-->
            <div class="col-sm-12 col-md-8" style="flex:0 0 100%; max-width: 100%">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm custom-tabs">

                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-customContent" role="tablist">
                            <a class="nav-item nav-link active" id="nav-profile" data-toggle="tab"
                               href="#custom-profile"
                               role="tab" aria-controls="nav-profile" aria-selected="false">
                                <i class="fa fa-file-text-o"></i> Thông tin
                            </a>
                            <a class="nav-item nav-link" id="nav-contact" data-toggle="tab" href="#custom-contact"
                               role="tab" aria-controls="nav-contact" aria-selected="false">
                                <i class="fas fa-edit"></i> Chỉnh sửa thông tin tài khoản
                            </a>
                        </div>
                    </nav>

                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-customContent">
                        <!--Personal info tab-->
                        <div class="tab-pane fade show active p-4" id="custom-profile" role="tabpanel"
                             aria-labelledby="nav-profile">
                            <form class="form-horizontal mt-4 mb-5" style="margin-top: 0px!important;">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="control-label" for="input-1"
                                               style="font-weight: 500; font-size: 18px; color: black;">Họ tên:
                                            <p style="float: right; font-size: 17px!important; margin-left: 20px; margin-bottom: 0px!important; margin-top: -3px;">{{Session::get('Auth')->name}}</p>
                                        </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label" for="input-3"
                                               style="font-weight: 500; font-size: 18px; color: black;">Email:
                                            <p style="float: right; font-size: 17px!important; margin-left: 20px; margin-bottom: 0px!important; margin-top: -3px;">{{Session::get('Auth')->email}}</p>
                                        </label>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="control-label" for="exampleFormControlSelect1"
                                               style="font-weight: 500; font-size: 18px; color: black;">Giới tính:
                                            <p style="float: right; font-size: 17px!important; margin-left: 20px; margin-bottom: 0px!important; margin-top: -3px;">{{Session::get('Auth')->gender}}</p>
                                        </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label" for="input-4"
                                               style="font-weight: 500; font-size: 18px; color: black;">Ngày sinh:
                                            <p style="float: right; font-size: 17px!important; margin-left: 20px; margin-bottom: 0px!important; margin-top: -3px;">{{Session::get('Auth')->birthday}}</p>
                                        </label>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="control-label" for="exampleFormControlSelect1"
                                               style="font-weight: 500; font-size: 18px; color: black;">Số điện thoại:
                                            <p style="float: right; font-size: 17px!important; margin-left: 20px; margin-bottom: 0px!important; margin-top: -3px;">{{Session::get('Auth')->phone}}</p>
                                        </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label" for="input-4"
                                               style="font-weight: 500; font-size: 18px; color: black;">Chức năng:
                                            @if(Session::get('Auth')->role_id==2)
                                                <p style="float: right; font-size: 17px!important; margin-left: 20px; margin-bottom: 0px!important; margin-top: -3px;">
                                                    Quản trị hệ thống</p>
                                            @endif
                                            @if(Session::get('Auth')->role_id==1)
                                                <p style="float: right; font-size: 17px!important; margin-left: 20px; margin-bottom: 0px!important; margin-top: -3px;">
                                                    Người dùng</p>
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="control-label" for="input-5"
                                               style="width: 915px; font-weight: 500; font-size: 18px; color: black">Địa
                                            chỉ:
                                            <p style="float: right; font-size: 17px!important; margin-left: 20px; margin-bottom: 0px!important; margin-top: -3px; display: contents;">{{Session::get('Auth')->address}}</p>
                                        </label>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                            </form>
                        </div>
                        <!--/Personal info tab-->

                        <!--Resume tab-->
                        <div class="tab-pane fade p-4" id="custom-contact" role="tabpanel"
                             aria-labelledby="nav-contact">
                            <form method="post" action="{{route('updateAdProfile')}}" class="form-horizontal mt-4 mb-5" style="margin-top: 0px!important;">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <p class="form">
                                        <label class="control-label" for="input-1">Tên người dùng</label>
                                        <input type="text" class="form-control" id="input-1" name="p_name" value="{{Session::get('Auth')->name}}"/>
                                            @error('mes')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="form">
                                        <label class="control-label" for="input-3">Ngày sinh</label>
                                        <input type="text" class="form-control" id="input-3" name="p_birthday" value="{{Session::get('Auth')->birthday}}"/>
                                            @error('mes')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <p class="form">
                                        <label class="control-label" for="exampleFormControlSelect1">Giới tính</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="p_gender">
                                            <option value="{{Session::get('Auth')->gender}}">{{Session::get('Auth')->gender}}</option>
                                            <option value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                            <option value="Khác">Khác</option>
                                        </select>
                                            @error('p_gender')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="form">
                                        <label class="control-label" for="input-4">Số điện thoại</label>
                                        <input type="number" maxlength="5" class="form-control" name="p_phone" id="input-4"
                                               value="{{Session::get('Auth')->phone}}"/>
                                        @error('mes')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin: auto; width: 100%; display: contents">
                                    <div class="col-sm-6" style="display: contents">
                                        <p class="form">
                                        <label class="control-label" for="input-5">Địa chỉ</label>
                                        <input type="text" class="form-control" id="input-5" name="p_address" value="{{Session::get('Auth')->address}}"/>
                                        @error('mes')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 40px">
                                    <div class="col-sm-6" style="margin: auto">
                                        <p class="form">
                                        <input type="submit" class="col-sm-12 btn btn-theme" name="update" value="Cập nhật thông tin" />
                                        @error('update')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        </p>
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

@extends('layout.index')

@section('content')

    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-0"><strong>Chỉnh sửa tài khoản</strong></h5>
        <span class="text-secondary">Trang chủ <i class="fa fa-angle-right"></i> Tài khoản <i
                class="fa fa-angle-right"></i> Chỉnh sửa tài khoản</span>
        <div class="row mt-3">
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
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h5 class="mb-0"><strong>Thông tin tài khoản</strong></h5>
                    <form method="post" action="{{route('user_update', $user->id)}}" class="form-horizontal mt-4 mb-5">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                <label class="control-label" for="input-1">Họ tên</label>
                                <input type="text" class="form-control" id="input-1" name="edit_name" value="{{$user->name}}"/>
                                    @error('edit_name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                <label class="control-label" for="input-2">Email</label>
                                <input type="text" class="form-control" id="input-2" name="edit_email" value="{{$user->email}}"/>
                                @error('edit_email')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                <label class="control-label" for="input-3">Ngày sinh</label>
                                <input type="date" class="form-control" id="input-3" name="edit_birthday" value="{{$user->birthday}}"/>
                                @error('edit_birthday')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                <label class="control-label" for="exampleFormControlSelect1">Giới tính</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="edit_gender">
                                    <option value="{{$user->gender}}">{{$user->gender}}</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                </select>
                                @error('edit_gender')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                <label class="control-label" for="input-4">Số điện thoại</label>
                                <input type="number" class="form-control" name="edit_phone" id="input-4"
                                       value="{{$user->phone}}"/>
                                @error('edit_phone')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                <label class="control-label" for="input-5">Địa chỉ</label>
                                <input type="text" class="form-control" id="input-5" name="edit_address" value="{{$user->address}}"/>
                                @error('edit_address')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                <label class="control-label" for="exampleFormControlSelect2">Phân quyền</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="edit_role">
                                    @if($user->role_id==1)
                                        <option value="1">Người dùng</option>
                                        <option value="2">Admin</option>
                                    @elseif($user->role_id==2)
                                        <option value="2">Admin</option>
                                        <option value="1">Người dùng</option>
                                    @endif
                                </select>
                                @error('edit_role')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                <label class="control-label" for="exampleFormControlSelect3">Trạng thái hoạt
                                    động</label>
                                <select class="form-control" id="exampleFormControlSelect3" name="edit_active">
                                    @if($user->active==1)
                                        <option value="1">Hoạt động</option>
                                        <option value="0">Tạm khóa</option>
                                    @elseif($user->active==0)
                                        <option value="0">Tạm khóa</option>
                                        <option value="1">Hoạt động</option>
                                    @endif
                                </select>
                                @error('edit_active')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                </p>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: 40px">
                            <div class="col-sm-6">
                                <a href="{{route('user')}}" class="col-sm-12 btn btn-danger">Hủy</a>
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" class="col-sm-12 btn btn-theme" name="edit_update" value="Cập nhật thông tin" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

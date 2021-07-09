@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <h5 class="mb-0" ><strong>Tạo tài khoản</strong></h5>
        <span class="text-secondary">Trang chủ <i class="fa fa-angle-right"></i> Tài khoản <i class="fa fa-angle-right"></i> Tạo tài khoản</span>

        <div class="row mt-3">
            <div class="col-sm-12">
                <!--Floating label-->
                <div class="mt-4 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h6 class="mb-3">Tạo tài khoản người dùng</h6>

                    <form form method="post" action="{{route('register')}}">
                        @csrf
                        @error('ok')
                        <small class="form-text text-danger" style="font-size: 15px">{{ $message }}</small>
                        @enderror
                        <p class="form">
                        <div class="form-group floating-label">
                            <input class="form-control" type="email" required name="r_email" id="r_email" value="{{old('r_email')}}" >
                            <label for="">Email</label>
                        </div>
                        @error('r_email')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        </p>
                        <p class="form">
                        <div class="form-group floating-label">
                            <input class="form-control" type="text" required name="r_userName" id="r_userName" value="{{old('r_userName')}}" >
                            <label for="">Họ tên</label>
                        </div>
                        @error('r_userName')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        </p>
                        <p class="form">
                        <div class="form-group floating-label">
                            <input class="form-control" type="date" required name="r_birthday" id="r_birthday" value="{{old('r_birthday')}}" >
                            <label for="">Ngày sinh</label>
                        </div>
                        @error('r_birthday')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        </p>
                        <p class="form">
                        <div class="form-group floating-label">
                            <input class="form-control" type="text" required name="r_gender" id="r_gender" value="{{old('r_gender')}}" >
                            <label for="">Giới tính</label>
                        </div>
                        @error('r_gender')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        </p>
                        <p class="form">
                        <div class="form-group floating-label">
                            <input class="form-control" type="number" required name="r_phone" id="r_phone" value="{{old('r_phone')}}" >
                            <label for="">Số điện thoại</label>
                        </div>
                        @error('r_phone')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        </p>
                        <p class="form">
                        <div class="form-group floating-label">
                            <input class="form-control" type="text" required name="r_address" id="r_address" value="{{old('r_address')}}" >
                            <label for="">Địa chỉ</label>
                        </div>
                        @error('r_address')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        </p>

                        <p class="form">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="create" value="Tạo mới" />
                        </div>
                        @error('create')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">


        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h5 class="mb-0"><strong>Chỉnh sửa người dùng</strong></h5>

                    <form class="form-horizontal mt-4 mb-5">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="control-label" for="input-1">Tên người dùng</label>
                                <input type="text" class="form-control" id="input-1" placeholder=""/>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="input-2">Email người dùng</label>
                                <input type="text" class="form-control" id="input-2" placeholder="johndoe@gmail.com"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="control-label" for="input-3">Ngày sinh</label>
                                <input type="date" class="form-control" id="input-3" placeholder="11/11/2019"/>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="exampleFormControlSelect1">Giới tính</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Choose ...</option>
                                    <option>Nam</option>
                                    <option>Nữ</option>
                                    <option>Khác</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="control-label" for="input-4">Số điện thoại</label>
                                <input type="text" maxlength="5" class="form-control" id="input-4" placeholder=""/>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="input-5">Địa chỉ</label>
                                <input type="text" class="form-control" id="input-5" placeholder=""/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="control-label" for="exampleFormControlSelect2">Phân quyền</label>
                                <select class="form-control" id="exampleFormControlSelect2">
                                    <option>Choose ...</option>
                                    <option>Admin</option>
                                    <option>Người dùng</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="exampleFormControlSelect3">Trạng thái hoạt động</label>
                                <select class="form-control" id="exampleFormControlSelect3">
                                    <option>Choose ...</option>
                                    <option>Hoạt động</option>
                                    <option>Tạm thời ngưng</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: 40px">
                            <div class="col-sm-6">
                                <button class="col-sm-12 btn btn-danger">Hủy</button>
                            </div>
                            <div class="col-sm-6">
                                <button class="col-sm-12 btn btn-theme">Đồng ý</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Footer-->
        <div class="row mt-5 mb-4 footer">
            <div class="col-sm-8">
                <span>&copy; All rights reserved 2019 designed by <a class="text-info" href="#">A-Fusion</a></span>
            </div>
            <div class="col-sm-4 text-right">
                <a href="#" class="ml-2">Contact Us</a>
                <a href="#" class="ml-2">Support</a>
            </div>
        </div>
        <!--Footer-->

    </div>
@endsection

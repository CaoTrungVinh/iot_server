@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h5 class="mb-0"><strong>Chỉnh sửa bộ đo</strong></h5>
                    <form class="form-horizontal mt-4 mb-5">
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="control-label" for="input-1">Tên bộ đo</label>
                                <input type="text" class="form-control" id="input-1" placeholder=""/>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="input-2">Vị trí đặt bộ đo</label>
                                <input type="text" class="form-control" id="input-2" placeholder=""/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="control-label" for="exampleFormControlSelect1">Thuộc ao nuôi</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Choose ...</option>
                                    <option>Nam</option>
                                    <option>Nữ</option>
                                    <option>Khác</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="input-2">Nhiệt độ an toàn nhỏ nhất</label>
                                <input type="number" class="form-control" id="input-2" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="control-label" for="input-2">Nhiệt độ an toàn lớn nhất</label>
                                <input type="number" class="form-control" id="input-2" placeholder=""/>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="input-2">Cảnh báo nhiệt độ</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Choose ...</option>
                                    <option>Bật</option>
                                    <option>Tắt</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="control-label" for="exampleFormControlSelect1">Ph an toàn nhỏ nhất</label>
                                <input type="number" class="form-control" id="input-2" placeholder=""/>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label" for="input-2">Ph an toàn lớn nhất</label>
                                <input type="number" class="form-control" id="input-2" placeholder=""/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="control-label" for="input-2">Cảnh báo Ph</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Choose ...</option>
                                    <option>Bật</option>
                                    <option>Tắt</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" style="margin-top: 40px">
                            <div class="col-sm-6">
                                <button class="col-sm-12 btn btn-danger"><a style="color: white; font-weight: normal" href="{{route('toolkit')}}">Hủy</a></button>
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

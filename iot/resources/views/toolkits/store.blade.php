@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h5 class="mb-0"><strong>Thêm bộ đo</strong></h5>
                    <form action="{{route('toolkit_store')}}" method="post" class="form-horizontal mt-4 mb-5">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="name">Tên bộ đo</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder=""/>
                                    @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="address">Vị trí đặt bộ đo</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder=""/>
                                    @error('address')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="exampleFormControlSelect1">Thuộc ao nuôi</label>
                                    <select class="form-control" name="id_pond" id="exampleFormControlSelect1">
                                        <option></option>
                                        @foreach($toolkit_create as $toolkit_create)
                                            <option value="{{$toolkit_create->id}}">{{$toolkit_create->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pond')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="temperature_min">Nhiệt độ an toàn nhỏ nhất</label>
                                    <input type="number" class="form-control" name="temperature_min"
                                           id="temperature_min" placeholder=""/>
                                    @error('temperature_min')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="temperature_max">Nhiệt độ an toàn lớn nhất</label>
                                    <input type="number" class="form-control" name="temperature_max"
                                           id="temperature_max" placeholder=""/>
                                    @error('temperature_max')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="exampleFormControlSelect1">Cảnh báo nhiệt
                                        độ</label>
                                    <select class="form-control" name="warning_temp" id="exampleFormControlSelect1">
                                        <option></option>
                                        <option value="1">Bật</option>
                                        <option value="0">Tắt</option>
                                    </select>
                                    @error('warning_temp')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="ph_min">Ph an toàn nhỏ nhất</label>
                                    <input type="number" class="form-control" name="ph_min" id="ph_min" placeholder=""/>
                                    @error('ph_min')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="ph_max">Ph an toàn lớn nhất</label>
                                    <input type="number" class="form-control" name="ph_max" id="ph_max" placeholder=""/>
                                    @error('ph_max')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="exampleFormControlSelect1">Cảnh báo Ph</label>
                                    <select class="form-control" name="warning_ph" id="exampleFormControlSelect1">
                                        <option></option>
                                        <option value="1">Bật</option>
                                        <option value="0">Tắt</option>
                                    </select>
                                    @error('warning_ph')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="input-2">Cảnh báo ánh sáng</label>
                                    <select class="form-control" name="warning_light" id="exampleFormControlSelect1">
                                        <option></option>
                                        <option value="1">Bật</option>
                                        <option value="0">Tắt</option>
                                    </select>
                                    @error('warning_light')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row" style="margin-top: 40px">
                            <div class="col-sm-6">
                                <a href="{{route('toolkit')}}" class="col-sm-12 btn btn-danger">Hủy</a>
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" class="col-sm-12 btn btn-theme" value="Đồng ý"/>
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

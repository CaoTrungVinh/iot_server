@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h5 class="mb-0"><strong>Chỉnh sửa bộ đo</strong></h5>
                    <form action="{{route('toolkit_update')}}" method="post" class="form-horizontal mt-4 mb-5">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$toolkitId->id}}" />
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="name">Tên bộ đo</label>
                                    <input type="text" value="{{$toolkitId->name}}" name="name" class="form-control"
                                           id="name" placeholder=""/>
                                    @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="address">Vị trí đặt bộ đo</label>
                                    <input type="text" value="{{$toolkitId->address}}" name="address"
                                           class="form-control" id="address" placeholder=""/>
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
                                        <option value="{{$pondId->id}}">{{$pondId->name}}</option>
                                        @foreach($pondall as $pondall)
                                            <option value="{{$pondall->id}}">{{$pondall->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pond')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="temperature">Nhiệt độ</label>
                                    <input type="number" value="{{$tempId->temperature}}" class="form-control"
                                           name="temperature"
                                           id="temperature" placeholder=""/>
                                    @error('temperature')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="temperature_min">Nhiệt độ an toàn nhỏ nhất</label>
                                    <input type="number" value="{{$tempId->temperature_min}}" class="form-control"
                                           name="temperature_min"
                                           id="temperature_min" placeholder=""/>
                                    @error('temperature_min')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="temperature_max">Nhiệt độ an toàn lớn nhất</label>
                                    <input type="number" value="{{$tempId->temperature_max}}" class="form-control"
                                           name="temperature_max"
                                           id="temperature_max" placeholder=""/>
                                    @error('temperature_max')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="exampleFormControlSelect1">Cảnh báo nhiệt
                                        độ</label>
                                    <select class="form-control" name="warning_temp" id="exampleFormControlSelect1">
                                        <option value="{{$tempId->warning}}">
                                            @if ($tempId->warning == 1)
                                                Bật
                                            @else
                                                Tắt
                                            @endif
                                        </option>
                                        <option value="1">Bật</option>
                                        <option value="0">Tắt</option>
                                    </select>
                                    @error('warning_temp')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="ph">Độ Ph</label>
                                    <input type="number" value="{{$phId->value}}" class="form-control" name="ph"
                                           id="ph" placeholder=""/>
                                    @error('ph')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="ph_min">Ph an toàn nhỏ nhất</label>
                                    <input type="number" value="{{$phId->ph_min}}" class="form-control" name="ph_min"
                                           id="ph_min" placeholder=""/>
                                    @error('ph_min')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="ph_max">Ph an toàn lớn nhất</label>
                                    <input type="number" value="{{$phId->ph_max}}" class="form-control" name="ph_max"
                                           id="ph_max" placeholder=""/>
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
                                        <option value="{{$phId->warning}}">
                                            @if ($phId->warning == 1)
                                                Bật
                                            @else
                                                Tắt
                                            @endif
                                        </option>
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
                                    <label class="control-label" for="input-2">Ánh sáng</label>
                                    <select class="form-control" name="light" id="exampleFormControlSelect1">
                                        <option value="{{$lightId->light}}">
                                            @if ($phId->light == 0)
                                                Ngày
                                            @else
                                                Đêm
                                            @endif
                                        </option>
                                        <option value="0">Ngày</option>
                                        <option value="1">Đêm</option>
                                    </select>
                                    @error('light')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="input-2">Cảnh báo ánh sáng</label>
                                    <select class="form-control" name="warning_light" id="exampleFormControlSelect1">
                                        <option value="{{$lightId->warning}}">
                                            @if ($lightId->warning == 1)
                                                Bật
                                            @else
                                                Tắt
                                            @endif
                                        </option>
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
                                <button class="col-sm-12 btn btn-danger"><a style="color: white; font-weight: normal"
                                                                            href="{{route('toolkit')}}">Hủy</a></button>
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

@extends('layout.indexUser')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h4 class="mb-0" style="text-align: center"><strong>Chỉnh sửa bộ đo</strong></h4>
                    <form action="{{route('postToolUpdate', $toolkitId->id)}}" method="post" class="form-horizontal mt-4 mb-5">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="name">Tên bộ đo</label>
                                    <input type="text" value="{{$toolkitId->name}}" name="upNameTool" class="form-control"
                                           id="name" placeholder=""/>
                                    @error('upNameTool')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="address">Trạng thái bộ đo</label>
                                    <select class="form-control" id="exampleFormControlSelect3" name="upAcTool">
                                        @if($toolkitId->active==1)
                                            <option value="1">Hoạt động</option>
                                            <option value="2">Tạm khóa</option>
                                        @elseif($toolkitId->active==2)
                                            <option value="2">Tạm khóa</option>
                                            <option value="1">Hoạt động</option>
                                        @endif
                                    </select>
                                    @error('upAcTool')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="exampleFormControlSelect1">Thuộc ao nuôi</label>
                                    <select class="form-control" name="upIDPondTool" id="exampleFormControlSelect1">
                                        <option value="{{$pondId->id}}">{{$pondId->name}}</option>
                                        @foreach($pondall as $pondall)
                                            @if($pondall->id_user==Session::get('User')->id)
                                            <option value="{{$pondall->id}}">{{$pondall->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('upIDPondTool')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
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
                        </div>

                        <div class="form-group row">
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
                            <p class="form">
                            <div class="col-sm-6">
                                <a href="{{route('configToolkit')}}" class="col-sm-12 btn btn-danger">Hủy</a>
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" class="col-sm-12 btn btn-theme" name="submit_updateTool" value="Xác nhận chỉnh sửa"/>
                            </div>
                            @error('submit_updateTool')
                            <small class="form-text text-danger" style="font-size: 15px; margin-top: 15px; margin-left: 50px">{{ $message }}</small>
                            @enderror
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


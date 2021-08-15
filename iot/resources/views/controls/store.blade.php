@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h5 class="mb-0"><strong>Thêm bộ điều khiển</strong></h5>
                    <form action="{{route('control_store')}}" method="post" class="form-horizontal mt-4 mb-5">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="name">Tên bộ điều khiển</label>
                                    <input type="text" name="nameControl" class="form-control" id="name"
                                           placeholder=""/>
                                    @error('nameControl')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="address">Vị trí lắp bộ điều khiển</label>
                                    <input type="text" name="addressControl" class="form-control" id="address"
                                           placeholder=""/>
                                    @error('addressControl')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="exampleFormControlSelect1">Thuộc ao nuôi</label>
                                    <select class="form-control" name="idPond" id="exampleFormControlSelect1">
                                        <option></option>
                                        @foreach($controls_create as $controls_create)
                                            @if($controls_create->active==1)
                                                <option value="{{$controls_create->id}}">ID: {{$controls_create->id}}
                                                    _{{$controls_create->name}} --- ({{$controls_create->users->id}}
                                                    : {{$controls_create->users->name}})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('idPond')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>

                        </div>

                        <div class="form-group row" style="margin-top: 40px">
                            <p class="form">
                            <div class="col-sm-6">
                                <a href="{{route('control')}}" class="col-sm-12 btn btn-danger">Hủy</a>
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" name="sub_control" class="col-sm-12 btn btn-theme"
                                       value="Xác nhận thêm"/>
                            </div>
                            @error('sub_control')
                            <small class="form-text text-danger"
                                   style="font-size: 15px; margin-top: 15px; margin-left: 50px">{{ $message }}</small>
                            @enderror
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

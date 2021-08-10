@extends('layout.indexUser')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h4 class="mb-0" style="text-align: center"><strong>Đăng ký thêm bộ đo</strong></h4>
                    <form action="{{route('postSingupToll')}}" method="post" class="form-horizontal mt-4 mb-5">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="name">Tên bộ đo</label>
                                    <input type="text" name="nameToolkit" class="form-control" id="name" placeholder="" value=""/>
                                    @error('nameToolkit')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="addressToolkit">Vị trí lắp bộ đo</label>
                                    <input type="text" name="addressToolkit" class="form-control" id="address" placeholder=""/>
                                    @error('addressToolkit')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="exampleFormControlSelect1">Thuộc ao nuôi</label>
                                    <select class="form-control" name="IDPond" id="exampleFormControlSelect1">
                                        <option></option>
                                        @foreach($toolkit_create as $toolkit_create)
                                            @if($toolkit_create->active==1)
                                            <option value="{{$toolkit_create->id}}">{{$toolkit_create->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('IDPond')
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
                                <input type="submit" class="col-sm-12 btn btn-theme" name="singupTool" value="Xác nhận đăng ký"/>
                            </div>
                            @error('singupTool')
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


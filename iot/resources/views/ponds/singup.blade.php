@extends('layout.indexUser')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h4 class="mb-0" style="text-align: center"><strong>Tạo thông tin ao nuôi</strong></h4>
                    <form action="{{route('postSingup')}}" method="post" class="form-horizontal mt-4 mb-5">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="name">Tên ao nuôi</label>
                                    <input type="text" class="form-control" name="namePond" placeholder=""/>
                                    @error('namePond')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>

                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="address">Địa chỉ</label>
                                    <input type="text" class="form-control" name="addressPond" placeholder=""/>
                                    @error('addressPond')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>


{{--                        <div class="form-group row">--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <p class="form">--}}
{{--                                    <label class="control-label" for="exampleFormControlSelect1">Số bộ đo đăng ký lắp đặt</label>--}}
{{--                                    <select name="singupToolkit" class="form-control" id="exampleFormControlSelect1">--}}
{{--                                        <option value="1">1</option>--}}
{{--                                        <option value="2">2</option>--}}
{{--                                        <option value="3">3</option>--}}
{{--                                        <option value="4">4</option>--}}
{{--                                        <option value="5">5</option>--}}
{{--                                        <option value="6">6</option>--}}
{{--                                        <option value="7">7</option>--}}
{{--                                        <option value="8">8</option>--}}
{{--                                        <option value="9">9</option>--}}
{{--                                        <option value="10">10</option>--}}
{{--                                    </select>--}}
{{--                                    @error('singupToolkit')--}}
{{--                                    <small class="form-text text-danger">{{ $message }}</small>--}}
{{--                                    @enderror--}}
{{--                                </p>--}}
{{--                            </div>--}}

{{--                            <div class="col-sm-6">--}}
{{--                                <p class="form">--}}
{{--                                    <label class="control-label" for="exampleFormControlSelect1">Số bộ điều khiển đăng ký lắp đặt</label>--}}
{{--                                    <select name="singupControl" class="form-control" id="exampleFormControlSelect1">--}}
{{--                                        <option value="0">0</option>--}}
{{--                                        <option value="1">1</option>--}}
{{--                                        <option value="2">2</option>--}}
{{--                                        <option value="3">3</option>--}}
{{--                                        <option value="4">4</option>--}}
{{--                                        <option value="5">5</option>--}}
{{--                                        <option value="6">6</option>--}}
{{--                                        <option value="7">7</option>--}}
{{--                                        <option value="8">8</option>--}}
{{--                                        <option value="9">9</option>--}}
{{--                                        <option value="10">10</option>--}}
{{--                                    </select>--}}
{{--                                    @error('singupControl')--}}
{{--                                    <small class="form-text text-danger">{{ $message }}</small>--}}
{{--                                    @enderror--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group row" style="margin-top: 40px">
                            <p class="form">
                            <div class="col-sm-6">
                                <a href="{{route('pondConfig')}}" class="col-sm-12 btn btn-danger">Hủy</a>
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" name="singupPond" class="col-sm-12 btn btn-theme" value="Xác nhận"/>
                            </div>
                            @error('singupPond')
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


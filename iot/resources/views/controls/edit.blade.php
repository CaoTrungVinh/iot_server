@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h5 class="mb-0"><strong>Thêm bộ điều khiển</strong></h5>
                    <form action="{{route('control_update')}}" method="post" class="form-horizontal mt-4 mb-5">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$controlId->id}}" />
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="name">Tên bộ điều khiển</label>
                                    <input type="text" value="{{$controlId->name}}" name="name" class="form-control" id="name" placeholder=""/>
                                    @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="address">Vị trí đặt bộ điều khiển</label>
                                    <input type="text" value="{{$controlId->address}}" name="address" class="form-control" id="address" placeholder=""/>
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

                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="control_pumpIn">Điều khiển bơm vào</label>
                                    <select class="form-control" name="control_pumpIn" id="control_pumpIn">
                                        <option value="{{$pumpInId->status}}">
                                            @if ($pumpInId->status == 0)
                                                Tắt
                                            @elseif ($pumpInId->status == 1)
                                                Bật
                                            @elseif ($pumpInId->status == 2)
                                                Hẹn giờ
                                            @endif
                                        </option>
                                        <option value="1">Bật</option>
                                        <option value="0">Tắt</option>
                                        <option value="2">Hẹn giờ</option>
                                    </select>
                                    @error('control_pumpIn')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="form">
                                            <label class="control-label" for="timer_pumpIn_On">Thời gian bật bơm vào ao</label>
                                            <input type="time" value="{{$pumpInId->timer_on}}" class="form-control" name="timer_pumpIn_On"
                                                   id="timer_pumpIn_On" placeholder=""/>
                                            @error('timer_pumpIn_On')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="form">
                                            <label class="control-label" for="timer_pumpIn_Off">Thời gian tắt bơm vào
                                                ao</label>
                                            <input type="time" value="{{$pumpInId->timer_off}}" class="form-control" name="timer_pumpIn_Off"
                                                   id="timer_pumpIn_Off" placeholder=""/>
                                            @error('timer_pumpIn_Off')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="control_pumpOut">Điều khiển bơm ra</label>
                                    <select class="form-control" name="control_pumpOut" id="control_pumpOut">
                                        <option value="{{$pumpOutId->status}}">
                                            @if ($pumpOutId->status == 0)
                                                Tắt
                                            @elseif ($pumpOutId->status == 1)
                                                Bật
                                            @elseif ($pumpOutId->status == 2)
                                                Hẹn giờ
                                            @endif
                                        </option>
                                        <option value="1">Bật</option>
                                        <option value="0">Tắt</option>
                                        <option value="2">Hẹn giờ</option>
                                    </select>
                                    @error('control_pumpOut')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="form">
                                            <label class="control-label" for="timer_pumpOut_On">Thời gian bật bơm ao ra ngoài</label>
                                            <input type="time" value="{{$pumpOutId->timer_on}}" class="form-control" name="timer_pumpOut_On"
                                                   id="timer_pumpOut_On" placeholder=""/>
                                            @error('timer_pumpOut_On')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="form">
                                            <label class="control-label" for="timer_pumpOut_Off">Thời gian tắt bơm ao ra ngoài</label>
                                            <input type="time" value="{{$pumpOutId->timer_off}}" class="form-control" name="timer_pumpOut_Off"
                                                   id="timer_pumpOut_Off" placeholder=""/>
                                            @error('timer_pumpOut_Off')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="control_lamp">Điều khiển đèn</label>
                                    <select class="form-control" name="control_lamp" id="control_lamp">
                                        <option value="{{$lampId->status}}">
                                            @if ($lampId->status == 0)
                                                Tắt
                                            @elseif ($lampId->status == 1)
                                                Bật
                                            @elseif ($lampId->status == 2)
                                                Hẹn giờ
                                            @endif
                                        </option>
                                        <option value="1">Bật</option>
                                        <option value="0">Tắt</option>
                                        <option value="2">Hẹn giờ</option>
                                    </select>
                                    @error('control_lamp')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="form">
                                            <label class="control-label" for="timer_lamp_On">Thời gian bật đèn</label>
                                            <input type="time" value="{{$lampId->timer_on}}" class="form-control" name="timer_lamp_On"
                                                   id="timer_lamp_On" placeholder=""/>
                                            @error('timer_lamp_On')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="form">
                                            <label class="control-label" for="timer_lamp_Off">Thời gian tắt đèn
                                            </label>
                                            <input type="time" value="{{$lampId->timer_off}}" class="form-control" name="timer_lamp_Off"
                                                   id="timer_lamp_Off" placeholder=""/>
                                            @error('timer_lamp_Off')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="control_oxy">Điều khiển quạt oxy</label>
                                    <select class="form-control" name="control_oxy" id="control_oxy">
                                        <option value="{{$oxygenId->status}}">
                                            @if ($oxygenId->status == 0)
                                                Tắt
                                            @elseif ($oxygenId->status == 1)
                                                Bật
                                            @elseif ($oxygenId->status == 2)
                                                Hẹn giờ
                                            @endif
                                        </option>
                                        <option value="1">Bật</option>
                                        <option value="0">Tắt</option>
                                        <option value="2">Hẹn giờ</option>
                                    </select>
                                    @error('control_oxy')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="form">
                                            <label class="control-label" for="timer_oxy_On">Thời gian bật quạt oxy</label>
                                            <input type="time" value="{{$oxygenId->timer_on}}" class="form-control" name="timer_oxy_On"
                                                   id="timer_oxy_On" placeholder=""/>
                                            @error('timer_oxy_On')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="form">
                                            <label class="control-label" for="timer_oxy_Off">Thời gian tắt quạt oxy
                                            </label>
                                            <input type="time" value="{{$oxygenId->timer_off}}" class="form-control" name="timer_oxy_Off"
                                                   id="timer_oxy_Off" placeholder=""/>
                                            @error('timer_oxy_Off')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
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

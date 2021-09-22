@extends('layout.indexUser')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h4 class="mb-0" style="text-align: center"><strong>Chỉnh sửa thông tin ao nuôi</strong></h4>
                    <form action="{{route('pondUpdate', $getDataId->id)}}" method="post" class="form-horizontal mt-4 mb-5">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="name">Tên ao nuôi</label>
                                    <input type="text" class="form-control" name="edit_namePond" id="name"
                                           value="{{$getDataId->name}}" placeholder=""/>
                                    @error('edit_namePond')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="address">Địa chỉ</label>
                                    <input type="text" class="form-control" name="edit_addressPond" id="address"
                                           value="{{$getDataId->address}}" />
                                    @error('edit_addressPond')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        @if(($getDataId->active)==0)
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <p class="form">
                                        <label class="control-label" for="address">Số bộ đo đăng ký lắp đặt</label>
                                        <input type="number" class="form-control" name="editToolkit" value="{{$getDataId->re_countToolkit}}"/>
                                        @error('editToolkit')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </p>
                                </div>

                                <div class="col-sm-6">
                                    <p class="form">
                                        <label class="control-label" for="address">Số bộ điều khiển đăng ký lắp đặt</label>
                                        <input type="number" class="form-control" name="editControl" value="{{$getDataId->re_countControl}}"/>
                                        @error('editControl')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <p class="form">
                                        <label class="control-label" for="exampleFormControlSelect3">Trạng thái ao nuôi</label>
                                        <select class="form-control" id="exampleFormControlSelect3" name="edit_activePond">
                                            @if($getDataId->active==1)
                                                <option value="1">Hoạt động</option>
                                                <option value="2">Tạm khóa</option>
                                            @elseif($getDataId->active==2)
                                                <option value="2">Tạm khóa</option>
                                                <option value="1">Hoạt động</option>
                                            @endif
                                        </select>
                                        @error('edit_activePond')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row" style="margin-top: 40px">
                            <div class="col-sm-6">
                                <p class="form">
                                <a href="{{route('pondConfig')}}" class="col-sm-12 btn btn-danger">Hủy</a>
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" name="submit_editPond" class="col-sm-12 btn btn-theme" value="Cập nhật thông tin"/>
                            </div>
                            @error('submit_editPond')
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


@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h5 class="mb-0"><strong>Thêm ao nuôi</strong></h5>
                    <form action="{{route('pond_store')}}" method="post" class="form-horizontal mt-4 mb-5">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                <label class="control-label" for="name">Tên ao nuôi</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder=""/>
                                    @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>

                            <div class="col-sm-6">
                                <p class="form">
                                <label class="control-label" for="address">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder=""/>
                                    @error('address')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                <label class="control-label" for="exampleFormControlSelect1">Người sở hữu</label>
                                <select name="user" class="form-control" id="exampleFormControlSelect1">
                                    <option></option>
                                    @foreach($pond_create as $pond_create)
                                        <option value="{{$pond_create->id}}">{{$pond_create->id}} - {{$pond_create->name}}</option>
                                    @endforeach
                                </select>
                                    @error('user')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row" style="margin-top: 40px">
                            <div class="col-sm-6">
                                <a href="{{route('pond')}}" class="col-sm-12 btn btn-danger">Hủy</a>
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" class="col-sm-12 btn btn-theme" value="Đồng ý"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

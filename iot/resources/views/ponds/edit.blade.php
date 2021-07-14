@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h5 class="mb-0"><strong>Chỉnh sửa ao nuôi</strong></h5>
                    <form action="{{route('pond_update')}}" method="post" class="form-horizontal mt-4 mb-5">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$getDataId->id}}" />

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="name">Tên ao nuôi</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           value="{{$getDataId->name}}" placeholder=""/>
                                    @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="address">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" id="address"
                                           value="{{$getDataId->address}}" placeholder=""/>
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
                                        <option value="{{$getDataId->users->id}}">{{$getDataId->users->name}}</option>

                                        @foreach($getData as $getData)
                                            <option value="{{$getData->id}}">{{$getData->name}}</option>
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
                                <button class="col-sm-12 btn btn-danger"><a style="color: white; font-weight: normal"
                                                                            href="{{route('pond')}}">Hủy</a></button>
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

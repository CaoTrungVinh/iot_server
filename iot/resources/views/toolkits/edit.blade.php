@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                    <h5 class="mb-0"><strong>Khôi phục bộ đo</strong></h5>
                    <form action="{{route('toolkitPostUndo', $toolkit->id)}}" method="post"
                          class="form-horizontal mt-4 mb-5">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="name">Tên bộ đo</label>
                                    <input type="text" value="{{$toolkit->name}}" name="nameTool" class="form-control"
                                           id="name" placeholder=""/>
                                    @error('nameTool')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="address">Vị trí đặt bộ đo</label>
                                    <input type="text" value="{{$toolkit->address}}" name="addressTool"
                                           class="form-control" id="address" placeholder=""/>
                                    @error('addressTool')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <p class="form">
                                    <label class="control-label" for="exampleFormControlSelect1">Thuộc ao nuôi</label>
                                    <select class="form-control" name="id_pondTool" id="exampleFormControlSelect1">
                                        <option value="{{$pond->id}}">ID: {{$pond->id}}_{{$pond->name}} ---
                                            ({{$user->id}}: {{$user->name}})</option>
                                        @foreach($pondAll as $pondall)
                                            <option value="{{$pondall->id}}">ID: {{$pondall->id}}_{{$pondall->name}} ---
                                                ({{$pondall->users->id}}: {{$pondall->users->name}})</option>
                                        @endforeach
                                    </select>
                                    @error('id_pondTool')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: 40px">
                            <p class="form">
                            <div class="col-sm-6">
                                <a href="{{route('toolkit')}}" class="col-sm-12 btn btn-danger">Hủy</a>
                            </div>
                            <div class="col-sm-6">
                                <input type="submit" name="sub_undo" class="col-sm-12 btn btn-theme" value="xác nhận"/>
                            </div>
                            @error('sub_undo')
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

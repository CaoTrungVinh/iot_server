@extends('layout.indexUser')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <div class="mt-1 mb-3 button-container">
            <div class="row pl-0">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3" onclick="window.location='{{route('pondConfig')}}'">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon">
                                {{--                                <i class="fas fa-users"></i>--}}
                                <img src="{{ asset('assets/img/pond.png') }}" style="width: 60px; height: 60px;"/>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong>{{$count_Pond}}</strong></h3>
                                <p>
                                    <small class="text-muted bc-description" style="color: black!important">Ao
                                        nuôi</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3"
                     onclick="window.location='{{route('configToolkit')}}'">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon">
                                {{--                                <i class="fas fa-user-check"></i>--}}
                                <img src="{{ asset('assets/img/microchip.png') }}" style="width: 60px; height: 60px;"/>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong>{{$sum_Tool}}</strong></h3>
                                <p>
                                    <small class="text-muted bc-description" style="color: black!important">Bộ
                                        đo</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3"
                     onclick="window.location='{{route('configControl')}}'">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon">
                                {{--                                <i class="fas fa-user-check"></i>--}}
                                <img src="{{ asset('assets/img/monitoring.png') }}" style="width: 60px; height: 60px;"/>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong>{{$sum_Control}}</strong></h3>
                                <p>
                                    <small class="text-muted bc-description" style="color: black!important">Bộ điều
                                        khiển</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-1 mb-3 button-container">
            <div class="p-3 bg-white border shadow-sm lh-sm">
                <div class="table-responsive product-list">

                    <table class="table table-bordered table-striped mt-0" id="productList">
                        <thead>
                        <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                            <th>Tên ao nuôi</th>
                            <th>Địa chỉ</th>
                            <th>Số Bộ đo</th>
                            <th>Số bộ điều khiển</th>
                            <th>Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($getPond as $getPond)
                            <tr style="text-align: center">
                                <td>{{$getPond->name}}</td>
                                <td>{{$getPond->address}}</td>
                                <td>{{$getPond->toolkits_count}}</td>
                                <td>{{$getPond->controls_count}}</td>
                                <td class="align-middle">
                                    @if(($getPond->active)==1)
                                        <span class="badge badge-success">Hoạt động</span>
                                    @elseif(($getPond->active)==2)
                                        <span class="badge badge-danger">Tạm khóa</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="text-right" style="margin-top: 5px">
                        <button class="btn btn-outline-theme"><a href="{{route('pondConfig')}}"><i class="fa fa-eye"
                                                                                             style="margin-right: 5px"></i>Chi
                                tiết</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


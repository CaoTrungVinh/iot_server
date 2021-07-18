@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <div class="mt-1 mb-3 button-container">
            <div class="row pl-0">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3" onclick="window.location='{{route('user')}}'">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon">
                                {{--                                <i class="fas fa-users"></i>--}}
                                <img src="{{ asset('assets/img/group.png') }}" style="width: 60px; height: 60px;"/>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong>{{$count_Account}}</strong></h3>
                                <p>
                                    <small class="text-muted bc-description" style="color: black!important">Tài khoản
                                        đăng ký</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3" onclick="window.location='{{route('user')}}'">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon">
                                {{--                                <i class="fas fa-user-check"></i>--}}
                                <img src="{{ asset('assets/img/user_pro.png') }}" style="width: 60px; height: 60px;"/>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong>{{$count_User}}</strong></h3>
                                <p>
                                    <small class="text-muted bc-description" style="color: black!important">Người
                                        dùng</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3" onclick="window.location='{{route('user')}}'">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon">
                                {{--                                <i class="fas fa-user-check"></i>--}}
                                <img src="{{ asset('assets/img/hire.png') }}" style="width: 60px; height: 60px;"/>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong>{{$count_Active}}</strong></h3>
                                <p>
                                    <small class="text-muted bc-description" style="color: black!important">Tài khoản
                                        hoạt động</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-8 col-md-8">
                <div class="p-3 bg-white border shadow-sm lh-sm">
                    <div class="table-responsive product-list">

                        <table class="table table-bordered table-striped mt-0" id="productList">
                            <thead>
                            <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($getAdmin as $getAdmin)
                                <tr style="text-align: center">
                                    <td>{{$getAdmin->name}}</td>
                                    <td>{{$getAdmin->email}}</td>
                                    <td>{{$getAdmin->phone}}</td>
                                    <td class="align-middle">
                                        @if ($getAdmin->active == 1)
                                            <span class="badge badge-success">Hoạt động</span>
                                        @else
                                            <span class="badge badge-danger">Tạm khóa</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="text-right" style="margin-top: 5px">
                            <button class="btn btn-outline-theme"><a href="{{route('user')}}"><i class="fa fa-eye"
                                                                                                 style="margin-right: 5px"></i>Chi
                                    tiết</a></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-md-4">
                <div class="bg-white border shadow mb-4" onclick="window.location='{{route('pond')}}'">
                    <div class="media p-4">
                        <div class="align-self-center mr-3 rounded-circle notify-icon_2 bg-white">
                            {{--                            <i class="fa fa-globe text-theme"></i>--}}
                            <img src="{{ asset('assets/img/pond.png') }}" style="width: 60px; height: 60px;"/>
                        </div>
                        <div class="media-body pl-2">
                            <h3 class="mt-0 mb-0"><strong>{{$count_Pond}}</strong></h3>
                            <p>
                                <small class="bc-description text-theme" style="color: black!important">Ao nuôi thủy
                                    sản</small>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border shadow mb-4" onclick="window.location='{{route('toolkit')}}'">
                    <div class="media p-4">
                        <div class="align-self-center mr-3 rounded-circle notify-icon_2 bg-white">
                            <img src="{{ asset('assets/img/microchip.png') }}" style="width: 60px; height: 60px;"/>
                        </div>
                        <div class="media-body pl-2">
                            <h3 class="mt-0 mb-0"><strong>{{$count_Toolkit}}</strong></h3>
                            <p>
                                <small class="bc-description text-danger" style="color: black!important">Bộ kit đo được
                                    lắp đặt</small>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border shadow" onclick="window.location='{{route('control')}}'">
                    <div class="media p-4">
                        <div class="align-self-center mr-3 rounded-circle notify-icon_2 bg-white">
                            <img src="{{ asset('assets/img/monitoring.png') }}" style="width: 60px; height: 60px;"/>
                        </div>
                        <div class="media-body pl-2">
                            <h3 class="mt-0 mb-0"><strong>{{$count_Control}}</strong></h3>
                            <p>
                                <small class="text-success bc-description" style="color: black!important;">Bộ điều khiển
                                    hoạt động</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--        <div class="mt-4 mb-4 p-3 bg-white border shadow-sm lh-sm">--}}
        {{--            <!--Order Listing-->--}}
        {{--            <div class="product-list">--}}

        {{--                <div class="row border-bottom mb-4">--}}
        {{--                    <div class="col-sm-8 pt-2"><h6 class="mb-4 bc-header">Order listing</h6></div>--}}
        {{--                </div>--}}
        {{--                <div class="table-responsive product-list">--}}
        {{--                    <table class="table table-bordered table-striped mt-0" id="productList">--}}
        {{--                        <thead>--}}
        {{--                        <tr>--}}
        {{--                            <th>Order ID</th>--}}
        {{--                            <th>Customer</th>--}}
        {{--                            <th>Status</th>--}}
        {{--                            <th>Total</th>--}}
        {{--                            <th>Order date</th>--}}
        {{--                        </tr>--}}
        {{--                        </thead>--}}
        {{--                        <tbody>--}}
        {{--                        <tr>--}}
        {{--                            <td>Ord#13</td>--}}
        {{--                            <td class="align-middle">--}}
        {{--                                Stephanie Cott--}}
        {{--                            </td>--}}
        {{--                            <td class="align-middle"><span class="badge badge-warning">Pending</span></td>--}}
        {{--                            <td class="align-middle">$200</td>--}}
        {{--                            <td>15/09/2018</td>--}}
        {{--                        </tr>--}}
        {{--                        <tr>--}}
        {{--                            <td>Ord#13</td>--}}
        {{--                            <td class="align-middle">--}}
        {{--                                Stephanie Cott--}}
        {{--                            </td>--}}
        {{--                            <td class="align-middle"><span class="badge badge-warning">Pending</span></td>--}}
        {{--                            <td class="align-middle">$200</td>--}}
        {{--                            <td>15/09/2018</td>--}}
        {{--                        </tr>--}}
        {{--                        <tr>--}}
        {{--                            <td>Ord#13</td>--}}
        {{--                            <td class="align-middle">--}}
        {{--                                Stephanie Cott--}}
        {{--                            </td>--}}
        {{--                            <td class="align-middle"><span class="badge badge-warning">Pending</span></td>--}}
        {{--                            <td class="align-middle">$200</td>--}}
        {{--                            <td>15/09/2018</td>--}}
        {{--                        </tr>--}}
        {{--                        <tr>--}}
        {{--                            <td>Ord#13</td>--}}
        {{--                            <td class="align-middle">--}}
        {{--                                Stephanie Cott--}}
        {{--                            </td>--}}
        {{--                            <td class="align-middle"><span class="badge badge-warning">Pending</span></td>--}}
        {{--                            <td class="align-middle">$200</td>--}}
        {{--                            <td>15/09/2018</td>--}}
        {{--                        </tr>--}}
        {{--                        <tr>--}}
        {{--                            <td>Ord#13</td>--}}
        {{--                            <td class="align-middle">--}}
        {{--                                Stephanie Cott--}}
        {{--                            </td>--}}
        {{--                            <td class="align-middle"><span class="badge badge-warning">Pending</span></td>--}}
        {{--                            <td class="align-middle">$200</td>--}}
        {{--                            <td>15/09/2018</td>--}}
        {{--                        </tr>--}}
        {{--                        <tr>--}}
        {{--                            <td>Ord#13</td>--}}
        {{--                            <td class="align-middle">--}}
        {{--                                Stephanie Cott--}}
        {{--                            </td>--}}
        {{--                            <td class="align-middle"><span class="badge badge-warning">Pending</span></td>--}}
        {{--                            <td class="align-middle">$200</td>--}}
        {{--                            <td>15/09/2018</td>--}}
        {{--                        </tr>--}}
        {{--                    </table>--}}
        {{--                    <div class="text-right">--}}
        {{--                        <button class="btn btn-outline-theme"><i class="fa fa-eye"></i> View full orders</button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

    </div>
@endsection

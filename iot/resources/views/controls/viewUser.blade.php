@extends('layout.indexUser')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <?php //Hiển thị thông báo thành công?>

        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif

        <?php //Hiển thị thông báo lỗi?>
        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif

        <div class="mt-4 mb-4 p-3 bg-white border shadow-sm lh-sm">
            <!--Order Listing-->
            <div class="product-list">
                <div class="row border-bottom mb-4">
                    <div class="col-sm-8 pt-2"><h5 class="mb-0"><strong>Cài đặt bộ điều khiển</strong></h5></div>
                    <div class="col-sm-4 text-right pb-3">
                        <button type="button" class="btn btn-danger shadow pull-right">
                            <a style="color: white; font-weight: normal" href="{{route('controlSingup')}}">Đăng ký thêm bộ điều
                                khiển</a>
                        </button>
                    </div>
                </div>

                <div class="table-responsive product-list">
                    <table class="table table-bordered mt-3" id="productList">
                        <thead>
                        <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                            <th>Thuộc ao</th>
                            <th>Trạng thái ao</th>
                            <th>Bộ điều khiển</th>
                            <th>Vị trí</th>
                            <th>Bơm vào</th>
                            <th>Bơm ra</th>
                            <th>Đèn</th>
                            <th>Quạt oxy</th>
                            <th>Trạng thái</th>
                            <th>Quản lý</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        Danh sách bộ đo chờ duyệt--}}
                        @foreach($controlSingup as $controlSingup)
                            @if($controlSingup->IDUser==Session::get('User')->id)
                                <tr style="text-align: center">
                                    <td>{{$controlSingup->name_pond}}</td>
                                    <td class="align-middle">
                                        <span class="badge badge-success">Hoạt động</span>
                                    </td>
                                    <td>{{$controlSingup->name_control}}</td>
                                    <td>{{$controlSingup->address}}</td>
                                    <td>Chưa lắp</td>
                                    <td>Chưa lắp</td>
                                    <td>Chưa lắp</td>
                                    <td>Chưa lắp</td>
                                    <td class="align-middle">
                                        <span class="badge badge-danger">Chờ duyệt</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button onclick="viewModalDelete({{$controlSingup->id}}, '{{$controlSingup->name_control}}')" class="btn btn-link text-danger p-1" id="btn_delete"><i class="fas fa-trash"></i></button>
                                    </td>

                                </tr>
                            @endif
                        @endforeach

{{--Danh sách ao nuôi--}}
                        @foreach($controls as $controls)
                            @if(($controls->IDUser == Session::get('User')->id) && $controls->activePond != 3 && $controls->activeControl != 3 && $controls->activeControl != 0)
                            <tr style="text-align: center">
                                <td>{{$controls->name_pond}}</td>
                                <td class="align-middle">
                                    @if($controls->activePond == 1)
                                        <span class="badge badge-success">Hoạt động</span>
                                    @elseif($controls->activePond == 2)
                                        <span class="badge badge-danger">Dừng hoạt động</span>
                                    @endif
                                </td>
                                <td>{{$controls->name_control}}</td>
                                <td>{{$controls->address}}</td>
                                <td>
                                    @if ($controls->pump_in == 0)
                                        Tắt
                                    @elseif ($controls->pump_in == 1)
                                        Bật
                                    @elseif ($controls->pump_in == 2)
                                        Hẹn giờ
                                    @endif
                                </td>
                                <td>
                                    @if ($controls->pump_out == 0)
                                        Tắt
                                    @elseif ($controls->pump_out == 1)
                                        Bật
                                    @elseif ($controls->pump_out == 2)
                                        Hẹn giờ
                                    @endif
                                </td>
                                <td>
                                    @if ($controls->lamp == 0)
                                        Tắt
                                    @elseif ($controls->lamp == 1)
                                        Bật
                                    @elseif ($controls->lamp == 2)
                                        Hẹn giờ
                                    @endif
                                </td>
                                <td>
                                    @if ($controls->oxygen_fan == 0)
                                        Tắt
                                    @elseif ($controls->oxygen_fan == 1)
                                        Bật
                                    @elseif ($controls->oxygen_fan == 2)
                                        Hẹn giờ
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($controls->activeControl == 1)
                                        <span class="badge badge-success">Hoạt động</span>
                                    @elseif($controls->activeControl == 2)
                                        <span class="badge badge-danger">Tạm khóa</span>
                                    @elseif($controls->activeControl == 4)
                                        <span class="badge badge-danger">Chưa kích hoạt</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center" style="display: inline-flex">
                                    <button onclick="showInfo({{$controls->id}})" class="btn btn-link" data-toggle="modal" data-target="#orderInfo"><a><i
                                                class="fa fa-eye"></i></a></button>
                                    @if($controls->activePond == 1)
                                    <a href="{{route('controlUpdate', $controls->id)}}" class="btn btn-link text-themestyle p-1"><i class="fa fa-pencil"></i></a>
                                    @endif
                                        <button onclick="viewModalDelete({{$controls->id}}, '{{$controls->name_control}}')" class="btn btn-link text-danger p-1" id="btn_delete"><i class="fas fa-trash"></i></button>
                                </td>

                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/Order Listing-->

            {{--            modal delete User--}}
            <div id="id01" class="modal" style="display: none; position: fixed; z-index: 1; left: 0; top: 0;  width: 50%;  height: 35%;  background-color: rgba(77, 85, 101, 0.44); margin: auto;">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
                <form class="modal-content">
                    <div class="container">
                        <h3 id="title_delete"></h3>
                        <p id="conten"></p>
                        <div class="clearfix">
                            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                            <button type="button" id="btn-de" class="deletebtn">Delete</button>
                        </div>
                    </div>
                </form>
            </div>

            <!--Order Info Modal-->
            <div class="modal fade" id="orderInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="margin-left: 8%">
                    <div class="modal-content" style="width: auto">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle" style="color: black!important;"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                                    <th>Vị trí</th>
                                    <th>Trạng thái</th>
                                    <th>Bơm vào</th>
                                    <th>Giờ bật bơm vào</th>
                                    <th>Giờ tắt bơm vào</th>
                                    <th>Bơm ra</th>
                                    <th>Giờ bật bơm ra</th>
                                    <th>Giờ tắt bơm ra</th>
                                    <th>Quạt</th>
                                    <th>Giờ bật quạt</th>
                                    <th>Giờ tắt quạt</th>
                                    <th>Đèn</th>
                                    <th>Giờ bật Đèn</th>
                                    <th>Giờ tắt Đèn</th>
                                    <th>Ngày lắp đặt</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="text-align: center; color: black!important;">
                                    <td id="addControl" ></td>
                                    <td id="acControl" ></td>
                                    <td id="pumpIn" ></td>
                                    <td id="bat_pumpIn" ></td>
                                    <td id="tat_pumpIn" ></td>
                                    <td id="pumpOut" ></td>
                                    <td id="bat_pumpOut" ></td>
                                    <td id="tat_pumpOut" ></td>
                                    <td id="quat" ></td>
                                    <td id="bat_quat" ></td>
                                    <td id="tat_quat" ></td>
                                    <td id="den" ></td>
                                    <td id="bat_den" ></td>
                                    <td id="tat_den" ></td>
                                    <td id="create" ></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('additionalJS')
            <script>
                function showInfo(c_id){
                    $.ajax({
                        url: '{!! url('/control/view') !!}'+ '/' + c_id,
                        type: 'GET',
                        success: function (data) {
                            document.getElementById("exampleModalLongTitle").innerText = "Thông tin chi tiết của bộ điều khiển " + data[0].name;
                            document.getElementById("addControl").innerText = data[0].address;
                            if (data[0].active == 1) {
                                document.getElementById("acControl").innerText = "Hoạt động";
                            } else {
                                document.getElementById("acControl").innerText = "Khóa";
                            }
                            if(data[1].status==0){
                                document.getElementById("pumpIn").innerText = "Tắt";
                            }else if(data[1].status==1){
                                document.getElementById("pumpIn").innerText = "Bật";
                            }else if(data[1].status==2){
                                document.getElementById("pumpIn").innerText = "Hẹn giờ";
                            }
                            document.getElementById("bat_pumpIn").innerText = data[1].timer_on;
                            document.getElementById("tat_pumpIn").innerText = data[1].timer_off;
                            if(data[2].status==0){
                                document.getElementById("pumpOut").innerText = "Tắt";
                            }else if(data[2].status==1){
                                document.getElementById("pumpOut").innerText = "Bật";
                            }else if(data[2].status==2){
                                document.getElementById("pumpOut").innerText = "Hẹn giờ";
                            }
                            document.getElementById("bat_pumpOut").innerText = data[2].timer_on;
                            document.getElementById("tat_pumpOut").innerText = data[2].timer_off;
                            if(data[4].status==0){
                                document.getElementById("quat").innerText = "Tắt";
                            }else if(data[4].status==1){
                                document.getElementById("quat").innerText = "Bật";
                            }else if(data[4].status==2){
                                document.getElementById("quat").innerText = "Hẹn giờ";
                            }
                            document.getElementById("bat_quat").innerText = data[4].timer_on;
                            document.getElementById("tat_quat").innerText = data[4].timer_off;
                            if(data[3].status==0){
                                document.getElementById("den").innerText = "Tắt";
                            }else if(data[3].status==1){
                                document.getElementById("den").innerText = "Bật";
                            }else if(data[3].status==2){
                                document.getElementById("den").innerText = "Hẹn giờ";
                            }
                            document.getElementById("bat_den").innerText = data[3].timer_on;
                            document.getElementById("tat_den").innerText = data[3].timer_off;
                            document.getElementById("create").innerText = data[0].create_date;
                        },
                        error: function (data) {
                            console.log('Error: ', data);
                        }
                    });
                }

                function viewModalDelete(c_id, c_name){
                    document.getElementById('id01').style.display='block';
                    document.getElementById("title_delete").innerText = "Xóa bộ điều khiển ".concat(c_name);
                    document.getElementById("conten").innerText = "Có chắc muốn xóa bộ điều khiển này?";

                    var de = document.getElementById('btn-de');
                    window.onclick = function(event) {
                        if (event.target == de) {
                            document.getElementById('id01').style.display='none';
                            location.href = '{!! url('/delete/control') !!}'+ '/' + c_id;
                        }
                    }
                }

            </script>
    @endpush
@endsection

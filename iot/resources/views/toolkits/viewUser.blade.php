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
                <button style="margin-right: 20px" type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif

        <div class="mt-4 mb-4 p-3 bg-white border shadow-sm lh-sm">
            <!--Order Listing-->
            <div class="product-list">
                <div class="row border-bottom mb-4">
                    <div class="col-sm-8 pt-2"><h5 class="mb-0"><strong>Cài đặt bộ đo</strong></h5></div>
                    <div class="col-sm-4 text-right pb-3">
                        <button type="button" class="btn btn-danger shadow pull-right">
                            <a style="color: white; font-weight: normal" href="{{route('showToolSingup')}}">Đăng ký thêm
                                bộ đo</a>
                        </button>
                    </div>
                </div>

                <div class="table-responsive product-list">
                    <table class="table table-bordered mt-3" id="productList">
                        <thead>
                        <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                            <th>Thuộc ao</th>
                            <th>Trạng thái ao</th>
                            <th>Bộ đo</th>
                            <th>Vị trí</th>
                            <th>Nhiệt độ</th>
                            <th>Độ Ph</th>
                            <th>Ánh sáng</th>
                            <th>Trạng thái</th>
                            <th>Tùy chọn</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--                        Danh sách ao nuôi đã đăng ký tạo mới --}}
                        @foreach($toolSingup as $toolSingup)
                            @if($toolSingup->idUser == Session::get('User')->id)
                                <tr style="text-align: center">
                                    <td>{{$toolSingup->name_pond}}</td>
                                    <td class="align-middle">
                                        <span class="badge badge-success">Hoạt động</span>
                                    </td>
                                    <td>{{$toolSingup->name_toolkit}}</td>
                                    <td>{{$toolSingup->address}}</td>
                                    <td>Null</td>
                                    <td>Null</td>
                                    <td>Null</td>
                                    <td class="align-middle">
                                        <span class="badge badge-danger">Chờ duyệt</span>
                                    </td>

                                    <td class="align-middle text-center">
                                        <button
                                            onclick="viewModalDelete({{$toolSingup->id}}, '{{$toolSingup->name_toolkit}}')"
                                            class="btn btn-link text-danger p-1" id="btn_delete"><i
                                                class="fas fa-trash"></i></button>
                                    </td>

                                </tr>
                            @endif
                        @endforeach

                        {{--Danh sách ao nuôi của người dùng--}}
                        @foreach($toolkits as $toolkits)
                            @if(($toolkits->idUser == Session::get('User')->id) && $toolkits->acivePond != 3 && $toolkits->active != 0 && $toolkits->active != 3)
                                <tr style="text-align: center">
                                    <td>{{$toolkits->name_pond}}</td>
                                    <td class="align-middle">
                                        @if($toolkits->acivePond == 1)
                                            <span class="badge badge-success">Hoạt động</span>
                                        @elseif($toolkits->acivePond == 2)
                                            <span class="badge badge-danger">Dừng hoạt động</span>
                                        @endif
                                    </td>
                                    <td>{{$toolkits->name_toolkit}}</td>
                                    <td>{{$toolkits->address}}</td>
                                    <td>{{$toolkits->temperature}}</td>
                                    <td>{{$toolkits->value}}</td>
                                    {{--<td>{{$toolkits->temperature}}</td>--}}
                                    {{--<td>{{$toolkits->temperature}}</td>--}}
                                    <td>
                                        @if ($toolkits->light == 0)
                                            Sáng
                                        @else
                                            Tối
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if($toolkits->active == 1)
                                            <span class="badge badge-success">Đang đo</span>
                                        @elseif($toolkits->active == 2)
                                            <span class="badge badge-danger">Tạm khóa</span>
                                        @elseif($toolkits->active == 4)
                                            <span class="badge badge-danger">Chưa kích hoạt</span>
                                        @endif
                                    </td>

                                    <td class="align-middle text-center" style="display: inline-flex">
                                        <button onclick="showInfo({{$toolkits->id}})" class="btn btn-link"
                                                data-toggle="modal" data-target="#orderInfo"><a><i
                                                    class="fa fa-eye"></i></a></button>
                                        @if($toolkits->acivePond == 1)
                                        <a href="{{route('ToolUpdate', $toolkits->id)}}"
                                           class="btn btn-link text-themestyle p-1"><i class="fa fa-pencil"></i></a>
                                        @endif
                                            <button
                                            onclick="viewModalDelete({{$toolkits->id}}, '{{$toolkits->name_toolkit}}')"
                                            class="btn btn-link text-danger p-1" id="btn_delete"><i
                                                class="fas fa-trash"></i></button>
                                    </td>

                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/Order Listing-->


            <div id="id01" class="modal"
                 style="display: none; position: fixed; z-index: 1; left: 0; top: 0;  width: 50%;  height: 35%;  background-color: rgba(77, 85, 101, 0.44); margin: auto;">
                <span onclick="document.getElementById('id01').style.display='none'" class="close_delete"
                      title="Close Modal">×</span>
                <form class="modal-content">
                    <div class="container">
                        <h3 id="title_delete"></h3>
                        <p id="conten"></p>
                        <div class="clearfix">
                            <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                    class="cancelbtn">Cancel
                            </button>
                            <button type="button" id="btn-de" class="deletebtn">Delete</button>
                        </div>
                    </div>
                </form>
            </div>


            <!--Order Info Modal-->
            <div class="modal fade" id="orderInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                                    <th>NĐ hiện tại</th>
                                    <th>Mức NĐ an toàn</th>
                                    <th>Cảnh báo NĐ</th>
                                    <th>pH hiện tại</th>
                                    <th>Mức pH an toàn</th>
                                    <th>Cảnh báo pH</th>
                                    <th>Cường độ AS</th>
                                    <th>Cảnh báo AS</th>
                                    <th>Ngày lắp</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="text-align: center; color: black!important;">
                                    <td id="vitri"></td>
                                    <td id="trangThai"></td>
                                    <td id="valueND"></td>
                                    <td id="ndmax"></td>
                                    <td id="cb_nd"></td>
                                    <td id="valuePH"></td>
                                    <td id="phmax"></td>
                                    <td id="cb_ph"></td>
                                    <td id="as"></td>
                                    <td id="cb_as"></td>
                                    <td id="dateCreate"></td>
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
            <!--Order Info Modal-->
        </div>
    </div>

    @push('additionalJS')
        <script>
            function showInfo(tool_id) {
                $.ajax({
                    url: '{!! url('/toolkit/view') !!}' + '/' + tool_id,
                    type: 'GET',
                    success: function (data) {
                        document.getElementById("exampleModalLongTitle").innerText = "Thông tin chi tiết của bộ đo " + data[0].name;
                        document.getElementById("vitri").innerText = data[0].address;
                        if (data[0].active == 1) {
                            document.getElementById("trangThai").innerText = "Đang đo";
                        } else {
                            document.getElementById("trangThai").innerText = "Khóa tạm thời";
                        }
                        document.getElementById("valueND").innerText = data[2].temperature;
                        document.getElementById("ndmax").innerText = data[2].temperature_min + " - " + data[2].temperature_max;
                        if (data[2].warning == 0) {
                            document.getElementById("cb_nd").innerText = "Tắt";
                        } else document.getElementById("cb_nd").innerText = "Bật";
                        document.getElementById("valuePH").innerText = data[1].value;
                        document.getElementById("phmax").innerText = data[1].ph_min + " - " + data[1].ph_max;
                        if (data[1].warning == 0) {
                            document.getElementById("cb_ph").innerText = "Tắt";
                        } else document.getElementById("cb_ph").innerText = "Bật";
                        if (data[3].light == 0) {
                            document.getElementById("as").innerText = "Tối";
                        } else document.getElementById("as").innerText = "Sáng";
                        if (data[3].warning == 0) {
                            document.getElementById("cb_as").innerText = "Tắt";
                        } else document.getElementById("cb_as").innerText = "Bật";
                        document.getElementById("dateCreate").innerText = data[0].create_date;
                    },
                    error: function (data) {
                        console.log('Error: ', data);
                    }
                });
            }

            function viewModalDelete(p_id, p_name) {
                document.getElementById('id01').style.display = 'block';
                document.getElementById("title_delete").innerText = "Xóa bộ đo ".concat(p_name);
                document.getElementById("conten").innerText = "Có chắc muốn xóa bộ đo này" + " ?";

                var de = document.getElementById('btn-de');
                window.onclick = function (event) {
                    if (event.target == de) {
                        document.getElementById('id01').style.display = 'none';
                        location.href = '{!! url('/delete/toolkit') !!}' + '/' + p_id;
                        // modal.style.display = "none";
                    }
                }
            }

        </script>
    @endpush
@endsection


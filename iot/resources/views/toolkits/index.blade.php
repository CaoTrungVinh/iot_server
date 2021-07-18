@extends('layout.index')
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
                    <div class="col-sm-8 pt-2"><h5 class="mb-0" ><strong>Quản lý bộ đo</strong></h5></div>
                    <div class="col-sm-4 text-right pb-3">
                        <button type="button" class="btn btn-danger shadow pull-right">
                            <a style="color: white; font-weight: normal" href="{{route('toolkit_create')}}">Thêm bộ đo</a>
                        </button>
                    </div>
                </div>

                <div class="table-responsive product-list">
                    <table class="table table-bordered mt-3" id="productList">
                        <thead>
                        <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                            <th>Tên ao</th>
                            <th>Tên bộ đo</th>
                            <th>Vị trí</th>
                            <th>Nhiệt độ</th>
                            {{--<th>Nhiệt độ an toàn</th>--}}
                            {{--<th>Ph an toàn</th>--}}
                            <th>Độ Ph</th>
                            <th>Ánh sáng</th>
                            <th>Quản lý</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($toolkits as $toolkits)
                            <tr style="text-align: center">
                                <td>{{$toolkits->name_pond}}</td>
                                <td>{{$toolkits->name_toolkit}}</td>
                                <td>{{$toolkits->address}}</td>
                                <td>{{$toolkits->temperature}}</td>
                                {{--<td>{{$toolkits->temperature}}</td>--}}
                                {{--<td>{{$toolkits->temperature}}</td>--}}
                                <td>{{$toolkits->value}}</td>
                                <td>
                                    @if ($toolkits->light == 0)
                                        Ban ngày
                                    @else
                                        Ban đêm
                                    @endif
                                </td>

                                <td class="align-middle text-center">
                                    <button onclick="showInfo({{$toolkits->id}})" class="btn btn-link" data-toggle="modal" data-target="#orderInfo"><a><i class="fa fa-eye"></i></a></button>
                                    <a href="{{route('toolkit_edit', $toolkits->id)}}" class="btn btn-link text-themestyle p-1"><i class="fa fa-pencil"></i></a>
                                    <button onclick="viewModalDelete({{$toolkits->id}}, '{{$toolkits->name_toolkit}}')" class="btn btn-link text-danger p-1" id="btn_delete"><i class="fas fa-trash"></i></button>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/Order Listing-->


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
            <div class="modal fade" id="orderInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                    <th>ID</th>
                                    <th>Tên Bộ đo</th>
                                    <th>Nhiệt độ nhỏ</th>
                                    <th>Nhiệt độ lớn</th>
                                    <th>Cảnh báo NĐ</th>
                                    <th>Ngày thêm NĐ</th>
                                    <th>pH nhỏ</th>
                                    <th>pH lớn</th>
                                    <th>Cảnh báo pH</th>
                                    <th>Ngày thêm pH</th>
                                    <th>Cảnh báo AS</th>
                                    <th>Ngày thêm AS</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="text-align: center; color: black!important;">
                                    <td id="tool_id" ></td>
                                    <td id="tool_name" ></td>
                                    <td id="ndmin" ></td>
                                    <td id="ndmax" ></td>
                                    <td id="cb_nd" ></td>
                                    <td id="date_nd" ></td>
                                    <td id="phmin" ></td>
                                    <td id="phmax" ></td>
                                    <td id="cb_ph" ></td>
                                    <td id="date_ph" ></td>
                                    <td id="cb_as" ></td>
                                    <td id="date_as" ></td>
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
            function showInfo(tool_id){
                $.ajax({
                    url: '{!! url('/toolkit/infor') !!}'+ '/' + tool_id,
                    type: 'GET',
                    success: function (data) {
                        document.getElementById("exampleModalLongTitle").innerText = "Thông tin chi tiết của bộ đo " + data[0].name;
                        document.getElementById("tool_id").innerText = data[0].id;
                        document.getElementById("tool_name").innerText = data[0].name;
                        document.getElementById("ndmin").innerText = data[2].temperature_min;
                        document.getElementById("ndmax").innerText = data[2].temperature_max;
                        if (data[2].warning == 0){
                            document.getElementById("cb_nd").innerText = "Tắt";
                        }else document.getElementById("cb_nd").innerText = "Bật";
                        document.getElementById("date_nd").innerText = data[2].created_at;
                        document.getElementById("phmin").innerText = data[1].ph_min;
                        document.getElementById("phmax").innerText = data[1].ph_max;
                        if (data[1].warning == 0){
                            document.getElementById("cb_ph").innerText = "Tắt";
                        }else document.getElementById("cb_ph").innerText = "Bật";
                        document.getElementById("date_ph").innerText = data[1].created_at;
                        if (data[3].warning == 0){
                            document.getElementById("cb_as").innerText = "Tắt";
                        }else document.getElementById("cb_as").innerText = "Bật";
                        document.getElementById("date_as").innerText = data[3].created_at;
                    },
                    error: function (data) {
                        console.log('Error: ', data);
                    }
                });
            }

            function viewModalDelete(p_id, p_name){
                document.getElementById('id01').style.display='block';
                document.getElementById("title_delete").innerText = "Xóa bộ đo ".concat(p_name);
                document.getElementById("conten").innerText = "Có chắc muốn xóa bộ đo có ID: " + p_id + " ?";

                var de = document.getElementById('btn-de');
                window.onclick = function(event) {
                    if (event.target == de) {
                        document.getElementById('id01').style.display='none';
                        location.href = '{!! url('/toolkit/delete') !!}'+ '/' + p_id;
                        // modal.style.display = "none";
                    }
                }
            }

        </script>
    @endpush
@endsection

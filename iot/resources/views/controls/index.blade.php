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
                    <div class="col-sm-8 pt-2"><h5 class="mb-0"><strong>Quản lý bộ điều khiển</strong></h5></div>
                    <div class="col-sm-4 text-right pb-3">
                        <button type="button" class="btn btn-danger shadow pull-right">
                            <a style="color: white; font-weight: normal" href="{{route('control_create')}}">Thêm bộ điều
                                khiển</a>
                        </button>
                    </div>
                </div>

                <div class="table-responsive product-list">
                    <table class="table table-bordered mt-3" id="productList">
                        <thead>
                        <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                            <th>Mã bộ ĐK</th>
                            <th>Ao nuôi</th>
                            <th>Trạng thái ao</th>
                            <th>Bộ điều khiển</th>
                            <th>Mã kích hoạt</th>
                            <th>ID bơm vào</th>
                            <th>ID bơm ra</th>
                            <th>ID đèn</th>
                            <th>ID quạt</th>
                            <th>Trạng thái</th>
                            <th>Quản lý</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($controls as $controls)
                            @if($controls->active!=0)
                            <tr style="text-align: center">
                                <td>{{$controls->id}}</td>
                                <td>{{$controls->name_pond}}</td>
                                <td class="align-middle">
                                    @if(($controls->activePond)==1)
                                        <span class="badge badge-success">Hoạt động</span>
                                    @elseif(($controls->activePond)==3)
                                        <span class="badge badge-danger">Tạm xóa</span>
                                    @elseif(($controls->activePond)==2)
                                        <span class="badge badge-danger">khóa</span>
                                    @endif
                                </td>
                                <td>{{$controls->name}}</td>
                                <td>{{$controls->key_active}}</td>
                                <td>{{$controls->id_pump_in}}</td>
                                <td>{{$controls->id_pump_out}}</td>
                                <td>{{$controls->id_lamp}}</td>
                                <td>{{$controls->id_oxygen_fan}}</td>
                                <td class="align-middle">
                                    @if(($controls->active)==1)
                                        <span class="badge badge-success">Hoạt động</span>
                                    @elseif(($controls->active)==3)
                                        <span class="badge badge-danger">Tạm xóa</span>
                                    @elseif(($controls->active)==2)
                                        <span class="badge badge-danger">khóa</span>
                                    @elseif(($controls->active)==4)
                                        <span class="badge badge-danger">Chờ kích hoạt</span>
                                    @endif
                                </td>

                                @if(($controls->active)==3)
                                    <td class="align-middle text-center" style="display: inline-flex">
                                        <button onclick="showInfo({{$controls->id}})" class="btn btn-link" data-toggle="modal" data-target="#orderInfo"><a><i class="fa fa-eye"></i></a></button>
                                        {{--                                    <a href="{{route('toolkit_edit', $toolkits->id)}}" class="btn btn-link text-themestyle p-1"><i class="fa fa-pencil"></i></a>--}}
                                        <a href="{{route('control_undo', $controls->id)}}" class="btn btn-link text-themestyle p-1" id="btn_Undo"><i class="fas fa-undo"></i></a>
                                        <button onclick="viewModalDelete({{$controls->id}}, '{{$controls->name}}')" class="btn btn-link text-danger p-1" id="btn_delete"><i class="fas fa-trash"></i></button>
                                    </td>
                                @else
                                    <td class="align-middle text-center">
                                        <button onclick="showInfo({{$controls->id}})" class="btn btn-link" data-toggle="modal" data-target="#orderInfo"><a><i class="fa fa-eye"></i></a></button>
                                    </td>
                                @endif
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
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content" style="width: auto">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle" style="color: black!important;">Tên</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                                    <th>Chủ sở hữu</th>
                                    <th>SĐT chủ</th>
                                    <th>Mã ao</th>
                                    <th>Địa chỉ ao</th>
                                    <th>Vị trí lắp</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày kích hoạt</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Ngày xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="text-align: center; color: black!important;">
                                    <td id="control_user" ></td>
                                    <td id="control_sdt" ></td>
                                    <td id="pond_id" ></td>
                                    <td id="pond_address" ></td>
                                    <td id="control_address" ></td>
                                    <td id="control_create" ></td>
                                    <td id="control_active" ></td>
                                    <td id="control_update" ></td>
                                    <td id="control_delete" ></td>
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
                    function showInfo(control_id){
                        $.ajax({
                            url: '{!! url('/admin/control/info') !!}'+ '/' + control_id,
                            type: 'GET',
                            success: function (data) {
                                document.getElementById("exampleModalLongTitle").innerText = "Thông tin chi tiết của ao nuôi " + data[0].name;
                                document.getElementById("control_user").innerText = data[2].name;
                                document.getElementById("control_sdt").innerText = data[2].phone;
                                    document.getElementById("pond_id").innerText = data[1].id;
                                    document.getElementById("pond_address").innerText = data[1].address;
                                    document.getElementById("control_address").innerText = data[0].address;
                                document.getElementById("control_create").innerText = data[0].create_date;
                                document.getElementById("control_active").innerText = data[0].date_active;
                                    document.getElementById("control_update").innerText = data[0].update_date;
                                    document.getElementById("control_delete").innerText = data[0].delete_date;
                            },
                            error: function (data) {
                                console.log('Error: ', data);
                            }
                        });
                    }

                    function viewModalDelete(p_id, p_name){
                        document.getElementById('id01').style.display='block';
                        document.getElementById("title_delete").innerText = "Xóa bộ điều khiển ".concat(p_name);
                        document.getElementById("conten").innerText = "Có chắc muốn xóa vĩnh viễn bộ điều khiển có ID: " + p_id + " ?";

                        var de = document.getElementById('btn-de');
                        window.onclick = function(event) {
                            if (event.target == de) {
                                document.getElementById('id01').style.display='none';
                                location.href = '{!! url('/admin/control/delete') !!}'+ '/' + p_id;
                            }
                        }
                    }

                </script>
    @endpush
@endsection

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
                    <div class="col-sm-8 pt-2"><h5 class="mb-0"><strong>Quản lý ao nuôi</strong></h5></div>
                    <div class="col-sm-4 text-right pb-3">
                        <button type="button" class="btn btn-danger shadow pull-right">
                            <a style="color: white; font-weight: normal" href="{{route('pond_create')}}">Thêm ao</a>
                        </button>
                    </div>
                </div>

                <div class="table-responsive product-list">
                    <table class="table table-bordered mt-3" id="productList">
                        <thead>
                        <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                            <th>Ao nuôi</th>
                            <th>Chủ sở hữu</th>
                            <th>SĐT chủ</th>
                            <th>Ngày tạo</th>
                            <th>Ngày sửa</th>
                            <th>Trạng thái</th>
                            <th>Ngày xóa</th>
                            <th>Quản lý</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ponds as $ponds)
                            <tr style="text-align: center">
                                <td>{{$ponds->name}}</td>
                                <td>{{$ponds->users->name}}</td>
                                <td>{{$ponds->users->phone}}</td>
                                <td>{{$ponds->created_date}}</td>
                                <td>{{$ponds->update_date}}</td>
                                <td class="align-middle">
                                    @if(($ponds->active)==1)
                                        <span class="badge badge-success">Hoạt động</span>
                                    @elseif(($ponds->active)==3)
                                        <span class="badge badge-danger">Tạm xóa</span>
                                    @elseif(($ponds->active)==2)
                                        <span class="badge badge-danger">khóa</span>
                                    @endif
                                </td>
                                <td>
                                    @if($ponds->active==3)
                                        {{$ponds->delete_date}}
                                    @else
                                        Null
                                    @endif
                                </td>

                                <td class="align-middle text-center">
                                    @if($ponds->active==3)
                                        <button onclick="viewModalUndo({{$ponds->id}}, '{{$ponds->name}}')"
                                                class="btn btn-link text-themestyle p-1" id="btn_Undo"><i
                                                class="fas fa-undo"></i></button>
                                        <button onclick="viewModalDelete({{$ponds->id}}, '{{$ponds->name}}')"
                                                class="btn btn-link text-danger p-1" id="btn_delete"><i
                                                class="fas fa-trash"></i></button>
                                    @else
                                    <button onclick="showInfo({{$ponds->id}}, '{{$ponds->users->email}}')" class="btn btn-link" data-toggle="modal" data-target="#orderInfo"><a><i class="fa fa-eye"></i></a></button>
{{--                                    <a href="{{route('pond_edit', $ponds->id)}}"--}}
{{--                                       class="btn btn-link text-themestyle p-1"><i class="fa fa-pencil"></i></a>--}}
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/Order Listing-->

            {{--            modal delete User--}}
            <div id="id01" class="modal"
                 style="display: none; position: fixed; z-index: 1; left: 0; top: 0;  width: 50%;  height: 35%;  background-color: rgba(77, 85, 101, 0.44); margin: auto;">
                <span onclick="document.getElementById('id01').style.display='none'" class="close"
                      title="Close Modal">×</span>
                <form class="modal-content">
                    <div class="container">
                        <h3 id="title_delete"></h3>
                        <p id="conten"></p>
                        <div class="clearfix">
                            <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                    class="cancelbtn">Hủy
                            </button>
                            <button type="button" id="btn-de" class="deletebtn">Xóa</button>
                        </div>
                    </div>
                </form>
            </div>


            {{--            modal Undo User--}}
            <div id="id02" class="modal"
                 style="display: none; position: fixed; z-index: 1; left: 0; top: 0;  width: 50%;  height: 35%;  background-color: rgba(77, 85, 101, 0.44); margin: auto;">
                <span onclick="document.getElementById('id02').style.display='none'" class="close"
                      title="Close Modal">×</span>
                <form class="modal-content">
                    <div class="container">
                        <h3 id="titleUndo"></h3>
                        <p id="contenUndo"></p>
                        <div class="clearfix">
                            <button type="button" onclick="document.getElementById('id02').style.display='none'"
                                    class="cancelbtn">Hủy
                            </button>
                            <button type="button" id="btn-undo" class="deletebtn">Xác nhận</button>
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
                                    <th>ID</th>
{{--                                    <th>Tên ao</th>--}}
                                    <th>Địa chỉ ao</th>
                                    <th>Email chủ sở hữu</th>
                                    <th>Bộ đo</th>
                                    <th>Bộ điều khiển</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="text-align: center; color: black!important;">
                                    <td id="p_id"></td>
{{--                                    <td id="p_name"></td>--}}
                                    <td id="p_address"></td>
                                    <td id="p_people"></td>
                                    <td id="p_toolkit"></td>
                                    <td id="p_control"></td>
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
            function showInfo(p_id, p_nguoi) {
                $.ajax({
                    url: '{!! url('/admin/pond/info') !!}' + '/' + p_id,
                    type: 'GET',
                    success: function (data) {
                        document.getElementById("exampleModalLongTitle").innerText = "Thông tin chi tiết ao nuôi " + data[0].name;
                        document.getElementById("p_id").innerText = data[0].id;
                        // document.getElementById("p_name").innerText = data[0].name;
                        document.getElementById("p_people").innerText = p_nguoi;
                        // document.getElementById("p_phone").innerText = p_phone;
                        document.getElementById("p_address").innerText = data[0].address;
                        document.getElementById("p_toolkit").innerText = data[0].toolkits_count;
                        document.getElementById("p_control").innerText = data[0].controls_count;
                    },
                    error: function (data) {
                        console.log('Error: ', data);
                    }
                });
            }

            function viewModalUndo(p_id, p_name) {
                document.getElementById('id02').style.display = 'block';
                document.getElementById("titleUndo").innerText = "Khôi phục lại ao nuôi ".concat(p_name);
                document.getElementById("contenUndo").innerText = "Có chắc muốn khôi phục ao nuôi này hoạt động lại bình thường?";

                var de = document.getElementById('btn-undo');
                window.onclick = function (event) {
                    if (event.target == de) {
                        document.getElementById('id01').style.display = 'none';
                        location.href = '{!! url('/admin/pond/undo') !!}' + '/' + p_id;
                        // modal.style.display = "none";
                    }
                }
            }

            function viewModalDelete(p_id, p_name) {
                document.getElementById('id01').style.display = 'block';
                document.getElementById("title_delete").innerText = "Xóa ao nuôi ".concat(p_name);
                document.getElementById("conten").innerText = "Có chắc muốn xóa ao nuôi có ID: " + p_id + " ?";

                var de = document.getElementById('btn-de');
                window.onclick = function (event) {
                    if (event.target == de) {
                        document.getElementById('id01').style.display = 'none';
                        location.href = '{!! url('admin/pond/delete') !!}' + '/' + p_id;
                        // modal.style.display = "none";
                    }
                }
            }

        </script>
    @endpush

@endsection

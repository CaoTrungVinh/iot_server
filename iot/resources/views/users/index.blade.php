@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
{{--        <h5 class="mb-0" ><strong>Tài khoản</strong></h5>--}}
{{--        <span class="text-secondary">Trang chủ <i class="fa fa-angle-right"></i> Tài khoản</span>--}}

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
                    <div class="col-sm-8 pt-2"><h5 class="mb-0" ><strong>Quản lý tài khoản</strong></h5></div>
                    <div class="col-sm-4 text-right pb-3">
                        <button type="button" class="btn btn-danger shadow pull-right">
                            <a style="color: white; font-weight: normal" href="{{route('create_user')}}">Thêm tài khoản</a>
                        </button>
                    </div>
                </div>
                <div class="table-responsive product-list">

                    <table class="table table-bordered mt-3" id="productList">
                        <thead>
                        <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                            <th>Họ tên</th>
                            <th>Email</th>
{{--                            <th>Ngày sinh</th>--}}
                            <th>Số điện thoại</th>
{{--                            <th>Giới tính</th>--}}
{{--                            <th>Địa chỉ</th>--}}
                            <th>Quyền</th>
                            <th>Trạng thái</th>
                            <th>Quản lý</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $data)
                        <tr style="text-align: center">
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
{{--                            <td>{{$data->birthday}}</td>--}}
                            <td>{{$data->phone}}</td>
{{--                            <td>{{$data->gender}}</td>--}}
{{--                            <td>{{$data->address}}</td>--}}
                            <td>
                                @if ($data->role_id == 2)
                                    Admin
                                @else
                                    Người dùng
                                @endif
                            </td>
                            <td class="align-middle">
                                @if ($data->active == 1)
                                    <span class="badge badge-success">Hoạt động</span>
                                @else
                                    <span class="badge badge-danger">Tạm khóa</span>
                                @endif
                            </td>

                            <td class="align-middle text-center">
                                {{--<button class="btn btn-theme" data-toggle="modal" data-target="#orderInfo"><i class="fa fa-eye"></i></button>--}}
                                <button onclick="showInfo({{$data->id}})" href="#" id="bt_view" class="btn btn-link" data-toggle="modal" data-target="#orderInfo"><i class="fa fa-eye"></i></button>
                                <a href="{{route('user_edit', $data->id)}}" class="btn btn-link text-themestyle p-1"><i class="fa fa-pencil"></i></a>
{{--                                <a onclick="deleteUser({{$data->id}})" class="btn btn-link text-danger p-1"><i class="fas fa-trash"></i></a>--}}
                                <button onclick="viewModalDelete({{$data->id}}, '{{$data->email}}')" class="btn btn-link text-danger p-1" id="btn_delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--Index users-->

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


            <!--modal view User-->
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
                            <table class="table table-striped table-bordered" id="datatable">
                                <thead>
                                <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                                    <th>ID</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Ngày sinh</th>
                                    <th>Số điện thoại</th>
                                    <th>Giới tính</th>
                                    <th>Địa chỉ</th>
                                    <th>Tổng ao nuôi</th>
                                    <th>Ngày tạo</th>
{{--                                    <th>Quyền</th>--}}
{{--                                    <th>Trạng thái</th>--}}
                                </tr>
                                </thead>
                                <tbody>

                                <tr style="text-align: center; color: black!important;">
                                    <td id="v_id" ></td>
                                    <td id="v_name" ></td>
                                    <td id="v_email" ></td>
                                    <td id="v_birthday" ></td>
                                    <td id="v_phone" ></td>
                                    <td id="v_gender" ></td>
                                    <td id="v_address" ></td>
                                    <td id="v_ponds" ></td>
                                    <td id="v_dateCreate" ></td>
{{--                                    <td id="v_roleID" ></td>--}}
{{--                                    <td id="v_active" ></td>--}}
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
            <!--modal view User-->

        </div>


    </div>
    @push('additionalJS')
        <script>
            function showInfo(u_id){
                $.ajax({
                    url: '{!! url('/admin/user/info') !!}'+ '/' + u_id,
                    type: 'GET',
                    success: function (data) {
                        document.getElementById("exampleModalLongTitle").innerText = "Thông tin chi tiết của tài khoản " + data[0].email;
                        document.getElementById("v_id").innerText = data[0].id;
                        document.getElementById("v_name").innerText = data[0].name;
                        document.getElementById("v_email").innerText = data[0].email;
                        document.getElementById("v_birthday").innerText = data[0].birthday;
                        document.getElementById("v_phone").innerText = data[0].phone;
                        document.getElementById("v_gender").innerText = data[0].gender;
                        document.getElementById("v_address").innerText = data[0].address;
                        document.getElementById("v_ponds").innerText = data[0].ponds_count;
                        document.getElementById("v_dateCreate").innerText = data[0].key_time;
                        // document.getElementById("v_roleID").innerText = data[0].role_id;
                        // document.getElementById("v_active").innerText = data[0].active;
                        // $("#orderInfo").modal('show')
                    },
                    error: function (data) {
                        console.log('Error: ', data);
                    }
                });
            }


            function viewModalDelete(u_id, U_email){
                document.getElementById('id01').style.display='block';
                document.getElementById("title_delete").innerText = "Xóa tài khoản ".concat(U_email);
                document.getElementById("conten").innerText = "Có chắc muốn xóa tài khoản có ID: " + u_id + " ?";

                var de = document.getElementById('btn-de');
                window.onclick = function(event) {
                    if (event.target == de) {
                        document.getElementById('id01').style.display='none';
                        location.href = '{!! url('/user/delete') !!}'+ '/' + u_id;
                        // modal.style.display = "none";
                    }
                }
            }

        </script>

{{--        <script>--}}
{{--            // Get the modal--}}
{{--            var modal = document.getElementById('id01');--}}
{{--            // When the user clicks anywhere outside of the modal, close it--}}
{{--            window.onclick = function(event) {--}}
{{--                if (event.target == modal) {--}}
{{--                    modal.style.display = "none";--}}
{{--                }--}}
{{--            }--}}
{{--        </script>--}}
    @endpush
@endsection

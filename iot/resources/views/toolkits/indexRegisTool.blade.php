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
                    <div class="col-sm-8 pt-2"><h5 class="mb-0"><strong>Danh sách đăng ký tạo bộ đo</strong></h5></div>
                </div>

                <div class="table-responsive product-list">
                    <table class="table table-bordered mt-3" id="productList">
                        <thead>
                        <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                            <th>Người đăng ký</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ người đăng ký</th>
                            <th>Ao nuôi</th>
                            <th>Mã ao</th>
                            <th>Tên bộ đo</th>
                            <th>Vị trí lắp</th>
                            <th>Xác nhận</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($toolkits as $toolkits)
                                <tr style="text-align: center">
                                    <td>{{$toolkits->userName}}</td>
                                    <td>{{$toolkits->phone}}</td>
                                    <td>{{$toolkits->addUser}}</td>
                                    <td>{{$toolkits->name_pond}}</td>
                                    <td>{{$toolkits->idPond}}</td>
                                    <td>{{$toolkits->name}}</td>
                                    <td>{{$toolkits->address}}</td>
                                        <td class="align-middle text-center">
                                            <button onclick="viewModalOk({{$toolkits->id}}, '{{$toolkits->name}}')" class="btn btn-link text-themestyle p-1" id="btn_Undo"><i class="fas fa-check"></i></button>
                                            <button onclick="viewModalDelete({{$toolkits->id}}, '{{$toolkits->name}}')" class="btn btn-link text-danger p-1" id="btn_delete"><i class="fas fa-times"></i></button>
                                        </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/Order Listing-->

{{-- model cancel--}}
            <div id="id01" class="modal" style="display: none; position: fixed; z-index: 1; left: 0; top: 0;  width: 50%;  height: 35%;  background-color: rgba(77, 85, 101, 0.44); margin: auto;">
                <span onclick="document.getElementById('id01').style.display='none'" class="close_delete" title="Close Modal">×</span>
                <form class="modal-content">
                    <div class="container">
                        <h3 id="title_delete"></h3>
                        <p id="conten"></p>
                        <div class="clearfix">
                            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Hủy</button>
                            <button type="button" id="btn-de" class="deletebtn">Xác nhận</button>
                        </div>
                    </div>
                </form>
            </div>

{{--            model ok--}}

            <div id="id02" class="modal" style="display: none; position: fixed; z-index: 1; left: 0; top: 0;  width: 50%;  height: 35%;  background-color: rgba(77, 85, 101, 0.44); margin: auto;">
                <span onclick="document.getElementById('id02').style.display='none'" class="close_delete" title="Close Modal">×</span>
                <form class="modal-content">
                    <div class="container">
                        <h3 id="title_ok"></h3>
                        <p id="conten_ok"></p>
                        <div class="clearfix">
                            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Hủy</button>
                            <button type="button" id="btn-ok" class="deletebtn">Đồng ý tạo</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @push('additionalJS')
        <script>

            function viewModalDelete(p_id, p_name){
                document.getElementById('id01').style.display='block';
                document.getElementById("title_delete").innerText = "Xóa bộ đo ".concat(p_name);
                document.getElementById("conten").innerText = "Có chắc muốn xóa bộ đo này khỏi danh sách đăng ký?";

                var de = document.getElementById('btn-de');
                window.onclick = function(event) {
                    if (event.target == de) {
                        document.getElementById('id01').style.display='none';
                        location.href = '{!! url('/admin/toolkit/register/cancel') !!}'+ '/' + p_id;
                        // modal.style.display = "none";
                    }
                }
            }

            function viewModalOk(p_id, p_name){
                document.getElementById('id02').style.display='block';
                document.getElementById("title_ok").innerText = "Xác nhận tạo bộ đo ".concat(p_name);
                document.getElementById("conten_ok").innerText = "Đồng ý thêm bộ đo mới vào hệ thống!!!";

                var de = document.getElementById('btn-ok');
                window.onclick = function(event) {
                    if (event.target == de) {
                        document.getElementById('id02').style.display='none';
                        location.href = '{!! url('/admin/toolkit/register/ok') !!}'+ '/' + p_id;
                        // modal.style.display = "none";
                    }
                }
            }

        </script>
    @endpush
@endsection


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
                    <div class="col-sm-8 pt-2"><h5 class="mb-0" ><strong>Danh sách bộ đo mới</strong></h5></div>
                    <div class="col-sm-4 text-right pb-3">
                        <button onclick="createNew()" class="btn btn-danger shadow pull-right">Thêm bộ đo</button>
                    </div>
                </div>

                <div class="table-responsive product-list">
                    <table class="table table-bordered mt-3" id="productList">
                        <thead>
                        <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                            <th>ID</th>
                            <th>Tên bộ đo</th>
                            <th>Khóa kích hoạt</th>
                            <th>Ngày tạo</th>
                            <th>Quản lý</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($newTool as $newTool)
                            <tr style="text-align: center">
                                <td>{{$newTool->id}}</td>
                                <td>{{$newTool->name}}</td>
                                <td>{{$newTool->key_active}}</td>
                                <td>{{$newTool->create_at}}</td>
                                <td class="align-middle text-center">
                                        <button onclick="viewModalDelete({{$toolkits->id}}, '{{$toolkits->name}}')" class="btn btn-link text-danger p-1" id="btn_delete"><i class="fas fa-trash"></i></button>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/Order Listing-->


            <div id="id01" class="modal" style="display: none; position: fixed; z-index: 1; left: 0; top: 0;  width: 50%;  height: 35%;  background-color: rgba(77, 85, 101, 0.44); margin: auto;">
                <span onclick="document.getElementById('id01').style.display='none'" class="close_delete" title="Close Modal">×</span>
                <form class="modal-content">
                    <div class="container">
                        <h4 id="title_delete">Thêm bộ đo mới</h4>
                        <p id="conten">Nhập tên bộ đo</p>
                        <input type="text" name="nameTookit" class="form-control" placeholder=""/>
                        <div class="clearfix">
                            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Hủy</button>
                            <button type="button" id="btn-new" class="deletebtn">Thêm mới</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('additionalJS')
        <script>

            function createNew(){
                document.getElementById('id01').style.display='block';
                var de = document.getElementById('btn-new');
                window.onclick = function(event) {
                    if (event.target == de) {
                        document.getElementById('id01').style.display='none';
                        location.href = '{!! url('/admin/create/NewToolkit') !!}';
                    }
                }
            }

        </script>
    @endpush
@endsection

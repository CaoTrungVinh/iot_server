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
                    <div class="col-sm-8 pt-2"><h5 class="mb-0" ><strong>Cài đặt ao nuôi</strong></h5></div>
                    <div class="col-sm-4 text-right pb-3">
                        <button type="button" class="btn btn-danger shadow pull-right">
                            <a style="color: white; font-weight: normal" href="{{route('pondSingup')}}">Tạo ao nuôi</a>
                        </button>
                    </div>
                </div>

                <div class="table-responsive product-list">
                    <table class="table table-bordered mt-3" id="productList">
                        <thead>
                        <tr style="color: #f6f6f7; background-color: #007bff; text-align: center">
                            <th>Tên ao</th>
                            <th>SĐT liên hệ</th>
                            <th>Địa chỉ ao</th>
                            <th>Số bộ đo</th>
                            <th>Số bộ điều khiển</th>
                            <th>Trạng thái</th>
                            <th>Tùy chọn</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pondUser as $pondUser)
                            @if($pondUser->active!=3)
                                <tr style="text-align: center">
                                    <td>{{$pondUser->name}}</td>
                                    <td>{{Session::get('User')->phone}}</td>
                                    <td>{{$pondUser->address}}</td>
                                    <td>{{$pondUser->toolkits_count}}</td>
                                    <td>{{$pondUser->controls_count}}</td>
                                    <td class="align-middle">
                                        @if(($pondUser->active)==1)
                                            <span class="badge badge-success">Hoạt động</span>
                                        @elseif(($pondUser->active)==0)
                                            <span class="badge badge-danger">Đăng ký</span>
                                        @elseif(($pondUser->active)==2)
                                            <span class="badge badge-danger">Tạm khóa</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{route('pondEdit', $pondUser->id)}}" class="btn btn-link text-themestyle p-1"><i class="fa fa-pencil"></i></a>
                                        <button onclick="viewModalDelete({{$pondUser->id}}, '{{$pondUser->name}}')" class="btn btn-link text-danger p-1" id="btn_delete"><i class="fas fa-trash"></i></button>
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
        </div>
    </div>

    @push('additionalJS')
        <script>
            function viewModalDelete(p_id, p_name){
                document.getElementById('id01').style.display='block';
                document.getElementById("title_delete").innerText = "Xóa ao nuôi ".concat(p_name);
                document.getElementById("conten").innerText = "Có chắc muốn xóa ao nuôi?";

                var de = document.getElementById('btn-de');
                window.onclick = function(event) {
                    if (event.target == de) {
                        document.getElementById('id01').style.display='none';
                        location.href = '{!! url('/delete/pond') !!}'+ '/' + p_id;
                        // modal.style.display = "none";
                    }
                }
            }

        </script>
    @endpush

@endsection


@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <!--Datatable-->
        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
            <h6 class="mb-2">Người dùng</h6>

            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                        <th>Giới tính</th>
                        <th>Địa chỉ</th>
                        <th>Quyền</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($data as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->birthday}}</td>
                            <td>{{$data->phone}}</td>
                            <td>{{$data->gender}}</td>
                            <td>{{$data->address}}</td>
                            <td>{{$data->role_id}}</td>

                            <td class="align-middle">
                                <span class="badge badge-success">Hoạt động</span>
                            </td>
                            <td class="align-middle text-center">
                                <button class="btn btn-link text-theme p-1"><i class="fa fa-eye"></i></button>
                                <button class="btn btn-link text-theme p-1"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-link text-danger p-1"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--/Datatable-->

    <!--Footer-->
        <div class="row mt-5 mb-4 footer">
            <div class="col-sm-8">
                <span>&copy; All rights reserved 2019 designed by <a class="text-info" href="#">A-Fusion</a></span>
            </div>
            <div class="col-sm-4 text-right">
                <a href="#" class="ml-2">Contact Us</a>
                <a href="#" class="ml-2">Support</a>
            </div>
        </div>
        <!--Footer-->

    </div>
@endsection
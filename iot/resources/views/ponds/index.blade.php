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
                    <div class="col-sm-8 pt-2"><h5 class="mb-0" ><strong>Quản lý ao nuôi</strong></h5></div>
                    <div class="col-sm-4 text-right pb-3">
                        <button type="button" class="btn btn-danger shadow pull-right">
                            <a style="color: white; font-weight: normal" href="{{route('pond_create')}}">Thêm ao</a>
                        </button>
                    </div>
                </div>

                <div class="table-responsive product-list">
                    <table class="table table-bordered mt-3" id="productList">
                        <thead>
                        <tr style="color: #f6f6f7;background: #007bff;">
                            <th>Tên ao</th>
                            <th>Người sở hữu</th>
                            <th>Địa chỉ ao</th>
                            <th>Quản lý</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ponds as $ponds)
                        <tr>
                            <td>{{$ponds->name}}</td>
                            <td>{{$ponds->users->name}}</td>
                            <td>{{$ponds->address}}</td>

                            <td class="align-middle text-center">
                                <button class="btn btn-theme" data-toggle="modal" data-target="#orderInfo"><a><i class="fa fa-eye"></i></a></button>
                                <button class="btn btn-success" data-toggle="modal"><a style="color: white" href="/pond/{{$ponds->id}}/edit"><i class="fa fa-pencil"></i></a></button>
                                <button class="btn btn-danger"><a style="color: white" href="/pond/{{ $ponds->id }}/delete"><i class="fas fa-trash"></i></a></button>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/Order Listing-->

            <!--Order Info Modal-->
            <div class="modal fade" id="orderInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tên</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Tên ao</th>
                                    <th>Người sở hữu</th>
                                    <th>Địa chỉ ao</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td scope="row">Red Shoes</td>
                                    <td>2</td>
                                    <td>$400</td>
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

            <!--Order Update Modal-->
            <div class="modal fade" id="orderUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Ord#13 details update</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th scope="row">Item</th>
                                    <th class="order-qty-head">Quantity</th>
                                    <th>Unit price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="align-middle">01</td>
                                    <td scope="row" class="align-middle">Red Shoes</td>
                                    <td class="text-center align-middle"><input type="text" value="2" class="order-qty"></td>
                                    <td class="align-middle">$400</td>
                                    <td class="align-middle">$800</td>
                                    <td style="width: 120px;" class="align-middle">
                                        <button class="btn btn-theme mr-1"><i class="fa fa-pencil-square-o"></i></button>
                                        <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">02</td>
                                    <td class="align-middle" scope="row">Blue shirt</td>
                                    <td class="text-center align-middle"><input type="text" value="1" class="order-qty"></td>
                                    <td class="align-middle">$400</td>
                                    <td class="align-middle">$400</td>
                                    <td class="align-middle">
                                        <button class="btn btn-theme mr-1"><i class="fa fa-pencil-square-o"></i></button>
                                        <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">03</td>
                                    <td class="align-middle" scope="row">Knickers</td>
                                    <td class="text-center align-middle"><input type="text" value="3" class="order-qty"></td>
                                    <td class="align-middle">$300</td>
                                    <td class="align-middle">$900</td>
                                    <td class="align-middle">
                                        <button class="btn btn-theme mr-1"><i class="fa fa-pencil-square-o"></i></button>
                                        <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </td>
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
            <!--Order Update Modal-->
        </div>

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

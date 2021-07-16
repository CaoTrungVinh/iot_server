@extends('layout.index')
@section('content')
    <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
        <div class="mt-1 mb-3 button-container">
            <div class="row pl-0">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong>$300k</strong></h3>
                                <p>
                                    <small class="text-muted bc-description">Total Revenue</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-danger">
                                <i class="fas fa-envelope-open"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong>3.1M</strong></h3>
                                <p>
                                    <small class="text-muted bc-description">Customers</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <div class="bg-theme border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-white">
                                <i class="fa fa-tags text-theme"></i>
                            </div>
                            <div class="media-body pl-2">
                                <h3 class="mt-0 mb-0"><strong>1022</strong></h3>
                                <p>
                                    <small class="bc-description text-white">Total Products</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-8 col-md-8">
                <div class="p-3 bg-white border shadow-sm lh-sm">
                    <div class="table-responsive product-list">

                        <table class="table table-bordered table-striped mt-0" id="productList">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Ord#19</td>
                                <td class="align-middle">
                                    Stephanie Cott
                                </td>
                                <td class="align-middle"><span class="badge badge-warning">Pending</span></td>
                                <td class="align-middle">$200</td>
                            </tr>
                            <tr>
                                <td>Ord#19</td>
                                <td class="align-middle">
                                    Stephanie Cott
                                </td>
                                <td class="align-middle"><span class="badge badge-warning">Pending</span></td>
                                <td class="align-middle">$200</td>
                            </tr>
                            <tr>
                                <td>Ord#19</td>
                                <td class="align-middle">
                                    Stephanie Cott
                                </td>
                                <td class="align-middle"><span class="badge badge-warning">Pending</span></td>
                                <td class="align-middle">$200</td>
                            </tr>
                            <tr>
                                <td>Ord#19</td>
                                <td class="align-middle">
                                    Stephanie Cott
                                </td>
                                <td class="align-middle"><span class="badge badge-warning">Pending</span></td>
                                <td class="align-middle">$200</td>
                            </tr>
                        </table>

                        <div class="text-right">
                            <button class="btn btn-outline-theme"><i class="fa fa-eye"></i> View full orders</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-md-4">
                <div class="bg-white border shadow mb-4">
                    <div class="media p-4">
                        <div class="align-self-center mr-3 rounded-circle notify-icon_2 bg-white">
                            <i class="fa fa-globe text-theme"></i>
                        </div>
                        <div class="media-body pl-2">
                            <h3 class="mt-0 mb-0"><strong>1,215,509</strong></h3>
                            <p>
                                <small class="bc-description text-theme">TOTAL VISITORS</small>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border shadow mb-4">
                    <div class="media p-4">
                        <div class="align-self-center mr-3 rounded-circle notify-icon_2 bg-white">
                            <i class="fa fa-heart-o text-danger"></i>
                        </div>
                        <div class="media-body pl-2">
                            <h3 class="mt-0 mb-0"><strong>83,509</strong></h3>
                            <p>
                                <small class="bc-description text-danger">MENTIONS</small>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white border shadow">
                    <div class="media p-4">
                        <div class="align-self-center mr-3 rounded-circle notify-icon_2 bg-white">
                            <i class="fa fa-lightbulb text-success"></i>
                        </div>
                        <div class="media-body pl-2">
                            <h3 class="mt-0 mb-0"><strong>2,500</strong></h3>
                            <p>
                                <small class="text-success bc-description">PROJECTS</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 mb-4 p-3 bg-white border shadow-sm lh-sm">
            <!--Order Listing-->
            <div class="product-list">

                <div class="row border-bottom mb-4">
                    <div class="col-sm-8 pt-2"><h6 class="mb-4 bc-header">Order listing</h6></div>
                </div>
                <div class="table-responsive product-list">
                    <table class="table table-bordered table-striped mt-0" id="productList">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Order date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Ord#13</td>
                            <td class="align-middle">
                                Stephanie Cott
                            </td>
                            <td class="align-middle"><span class="badge badge-warning">Pending</span></td>
                            <td class="align-middle">$200</td>
                            <td>15/09/2018</td>
                        </tr>
                        <tr>
                            <td>Ord#13</td>
                            <td class="align-middle">
                                Stephanie Cott
                            </td>
                            <td class="align-middle"><span class="badge badge-warning">Pending</span></td>
                            <td class="align-middle">$200</td>
                            <td>15/09/2018</td>
                        </tr>
                        <tr>
                            <td>Ord#13</td>
                            <td class="align-middle">
                                Stephanie Cott
                            </td>
                            <td class="align-middle"><span class="badge badge-warning">Pending</span></td>
                            <td class="align-middle">$200</td>
                            <td>15/09/2018</td>
                        </tr>
                        <tr>
                            <td>Ord#13</td>
                            <td class="align-middle">
                                Stephanie Cott
                            </td>
                            <td class="align-middle"><span class="badge badge-warning">Pending</span></td>
                            <td class="align-middle">$200</td>
                            <td>15/09/2018</td>
                        </tr>
                        <tr>
                            <td>Ord#13</td>
                            <td class="align-middle">
                                Stephanie Cott
                            </td>
                            <td class="align-middle"><span class="badge badge-warning">Pending</span></td>
                            <td class="align-middle">$200</td>
                            <td>15/09/2018</td>
                        </tr>
                        <tr>
                            <td>Ord#13</td>
                            <td class="align-middle">
                                Stephanie Cott
                            </td>
                            <td class="align-middle"><span class="badge badge-warning">Pending</span></td>
                            <td class="align-middle">$200</td>
                            <td>15/09/2018</td>
                        </tr>
                    </table>
                    <div class="text-right">
                        <button class="btn btn-outline-theme"><i class="fa fa-eye"></i> View full orders</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Footer-->
        <div class="row mt-5 mb-4 footer">
            <div class="col-sm-8">
                <span>&copy; All rights reserved 2019 designed by <a class="text-theme" href="#">A-Fusion</a></span>
            </div>
            <div class="col-sm-4 text-right">
                <a href="#" class="ml-2">Contact Us</a>
                <a href="#" class="ml-2">Support</a>
            </div>
        </div>
        <!--Footer-->

    </div>
    </div>
@endsection

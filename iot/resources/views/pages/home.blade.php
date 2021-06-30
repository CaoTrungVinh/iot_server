@extends('layout.index')
@section('content')
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-3"><strong>Dashboard</strong></h5>

    <div class="row mt-3">
        <div class="col-sm-12 col-md-8">
            <!--Analytics-->
            <div class="mt-1 mb-3 p-3 button-container bg-white shadow-sm border">
                <h6 class="mb-3">Analytics</h6>
                <hr>

                <canvas id="orderRevenue" class="orderRevenue" height="120px"></canvas>

            </div>
            <!--/Analytics-->

        </div>


        <div class="col-sm-12 col-md-4">
            <!--Custom Sales small chart-->
            <div class="mt-1 mb-3 button-container bg-white border shadow-sm lh-sm">
                <div class="fb-follow-widget">
                    <div class="fb-widget-top bg-theme text-white">
                        <div class="row p-3 fb-widget-top-desc">
                            <div class="col-sm-6 col-6">
                                <h5>Sales</h5>
                                <small>2016.9.12</small>
                            </div>
                            <div class="col-sm-6 col-6 text-right">
                                <h5><i class="fa fa-caret-up"></i> 260</h5>
                                <small>2016.9.12</small>
                            </div>
                        </div>
                        <div class="ct-chart" id="areaChartFb" style="width: 100%; height:100px"></div>
                    </div>
                    <div class="fb-widget-bottom">
                        <div class="row p-3 fb-widget-bottom">
                            <div class="col-sm-6 col-6 fb-wb-inner">
                                <p>
                                    <small><i class="fa fa-circle text-danger"></i> 32% dietary intake</small>
                                </p>
                                <p>
                                    <small><i class="fa fa-circle text-theme"></i> 68% motion capture</small>
                                </p>
                                <h5>Total : <span class="text-theme">3000</span></h5>
                            </div>
                            <div class="col-sm-6 col-6 text-right">
                                <div id="fbFollowChart" style="height: 130px"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--/Custom Sales small chart-->
        </div>
    </div>

    <!--Custom cards section-->
    <div class="row">
        <!--Visitors statistics card-->
        <div class="col-sm-4 custom-card">
            <div class="mt-1 mb-3 button-container p-3 bg-white border shadow lh-sm">
                <div class="text-center mb-3">
                    <h5 class="mb-0 mt-2">
                        <small>Visitors</small>
                    </h5>
                    <h2>2,367</h2>
                </div>

                <svg viewBox="0 0 36 25" class="circular-chart blue">
                    <path class="circle-bg"
                          d="M18 2.0845
                                    a 7.9567 7.9567 0 0 1 0 15.9134
                                    a 7.9567 7.9567 0 0 1 0 -15.9134"
                    />
                    <path class="circle"
                          stroke-dasharray="40, 60"
                          d="M18 2.0845
                                    a 7.9567 7.9567 0 0 1 0 15.9134
                                    a 7.9567 7.9567 0 0 1 0 -15.9134"
                    />
                    <text x="18" y="12.00" class="percentage">&#xf0c0;</text>
                </svg>
                <div class="row mx-2">
                    <div class="col-sm-6 col-12">
                        <h5>1,507</h5>
                        <span class="text-muted small"><strong>Male visitors</strong></span>
                    </div>
                    <div class="col-sm-6 col-12 text-right">
                        <h5>854</h5>
                        <span class="text-muted small"><strong>Female visitors</strong></span>
                    </div>
                </div>
            </div>
        </div>
        <!--/Visitors statistics card-->

        <!--Transaction statistics card-->
        <div class="col-sm-4 custom-card">
            <div class="mt-1 mb-3 button-container p-3 bg-white border shadow lh-sm">
                <div class="text-center mb-3">
                    <h5 class="mb-0 mt-2">
                        <small>Transactions</small>
                    </h5>
                    <h2>15,367</h2>
                </div>

                <svg viewBox="0 0 36 25" class="circular-chart red">
                    <path class="circle-bg"
                          d="M18 2.0845
                                    a 7.9567 7.9567 0 0 1 0 15.9134
                                    a 7.9567 7.9567 0 0 1 0 -15.9134"
                    />
                    <path class="circle"
                          stroke-dasharray="40, 60"
                          d="M18 2.0845
                                    a 7.9567 7.9567 0 0 1 0 15.9134
                                    a 7.9567 7.9567 0 0 1 0 -15.9134"
                    />
                    <text x="18" y="12.00" class="percentage">&#xf1ed;</text>
                </svg>

                <div class="row mx-2">
                    <div class="col-sm-6 col-12">
                        <h5>15,300</h5>
                        <span class="text-muted small"><strong>Payments done</strong></span>
                    </div>
                    <div class="col-sm-6 col-12 text-right">
                        <h5>67</h5>
                        <span class="text-muted small"><strong>Payments due</strong></span>
                    </div>
                </div>
            </div>
        </div>
        <!--/Transaction statistics card-->

        <!--Tasks statistics card-->
        <div class="col-sm-4 custom-card">
            <div class="mt-1 mb-3 button-container p-3 bg-white border shadow lh-sm">
                <div class="text-center mb-3">
                    <h5 class="mb-0 mt-2">
                        <small>Tasks</small>
                    </h5>
                    <h2>585</h2>
                </div>

                <svg viewBox="0 0 36 25" class="circular-chart green">
                    <path class="circle-bg"
                          d="M18 2.0845
                                    a 7.9567 7.9567 0 0 1 0 15.9134
                                    a 7.9567 7.9567 0 0 1 0 -15.9134"
                    />
                    <path class="circle"
                          stroke-dasharray="40, 60"
                          d="M18 2.0845
                                    a 7.9567 7.9567 0 0 1 0 15.9134
                                    a 7.9567 7.9567 0 0 1 0 -15.9134"
                    />
                    <text x="18" y="12.00" class="percentage">&#xf0ae;</text>
                </svg>

                <div class="row mx-2">
                    <div class="col-sm-6 col-12">
                        <h5>490</h5>
                        <span class="text-muted small"><strong>Completed</strong></span>
                    </div>
                    <div class="col-sm-6 col-12 text-right">
                        <h5>95</h5>
                        <span class="text-muted small"><strong>Pending</strong></span>
                    </div>
                </div>
            </div>
        </div>
        <!--Transaction statistics card-->
    </div>

</div>
@endsection

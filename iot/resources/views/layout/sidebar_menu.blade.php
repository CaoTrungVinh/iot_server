<div class="col-sm-3 col-xs-6 sidebar pl-0">
    <div class="inner-sidebar mr-3">
        <!--Image Avatar-->
        <div class="avatar text-center">
            <img href="{{route('home')}}" src="assets/img/logo.png"  alt="" class="rounded-circle" />
            <p><strong>chuongvinhiot2021@gmail.com</strong></p>
            <span class="text-primary small"><strong>0392387593</strong></span>
        </div>
        <!--Image Avatar-->

        <!--Sidebar Navigation Menu-->
        <div class="sidebar-menu-container">
            <ul class="sidebar-menu mt-4 mb-4">
                <li class="parent">
                    <a href="{{route('home')}}" class=""><i class="fa fa-dashboard mr-3"></i>
                        <span class="none">Trang chủ </span>
                    </a>
                </li>
                <li class="parent">
                    <a href="{{route('user')}}" class=""><i class="fa fa-user mr-3"></i>
                        <span class="none">Quản lý tài khoản </span>
                    </a>
                </li>
                <li class="parent">
                    <a href="#" onclick="toggle_menu('charts'); return false" class=""><i class="fa fa-pie-chart mr-3"></i>
                        <span class="none">Quản lý ao nuôi<i class="fa fa-angle-down pull-right align-bottom"></i></span>
                    </a>
                    <ul class="children" id="charts">
                        <li class="child"><a href="chart.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i>Ao nuôi</a></li>
                        <li class="child"><a href="chartist.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i>Thiết bị đo</a></li>
                        <li class="child"><a href="echarts.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i>Bộ điều khiển</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--Sidebar Naigation Menu-->
    </div>
</div>

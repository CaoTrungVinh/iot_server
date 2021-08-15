<div class="col-sm-3 col-xs-6 sidebar pl-0">
    <div class="inner-sidebar mr-3">
        <!--Image Avatar-->
        <div class="avatar text-center">
            <img href="{{route('home')}}" src="{{ asset('assets/img/logo.png') }}"  alt="" class="rounded-circle" />
{{--            <span class="text-primary small"><strong  style="">Hệ thống giám sát ao nuôi</strong></span>--}}
            <p class="text-primary small"><strong style="font-size: 18px">Hệ thống giám sát ao nuôi</strong></p>
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
                        <a href="{{route('pond')}}" class=""><i class="fa fa-tasks mr-3"></i>
                            <span class="none">Quản lý ao nuôi </span>
                        </a>
                    </li>
                    <li class="parent">
                        <a href="{{route('toolkit')}}" class=""><i class="fa fa-tasks mr-3"></i>
                            <span class="none">Quản lý bộ đo </span>
                        </a>
                    </li>
                    <li class="parent">
                        <a href="{{route('control')}}" class=""><i class="fa fa-tasks mr-3"></i>
                            <span class="none">Quản lý bộ điều khiển </span>
                        </a>
                    </li>
                    <li class="parent">
                        <a href="#" onclick="toggle_menu('charts'); return false" class=""><i class="fas fa-edit mr-3"></i>
                            <span class="none">Danh sách đăng ký<i class="fa fa-angle-down pull-right align-bottom"></i></span>
                        </a>
                        <ul class="children" id="charts">
                            <li class="child"><a href="{{route('re_toolkit')}}" class="ml-4"><i class="fa fa-angle-right mr-2"></i>Bộ đo</a></li>
                            <li class="child"><a href="{{route('reControl')}}" class="ml-4"><i class="fa fa-angle-right mr-2"></i>Bộ điều khiển</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        <!--Sidebar Naigation Menu-->
    </div>
</div>

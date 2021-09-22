<div class="col-sm-3 col-xs-6 sidebar pl-0">
    <div class="inner-sidebar mr-3">
        <!--Image Avatar-->
        <div class="avatar text-center">
            <img href="{{route('home')}}" src="{{ asset('assets/img/logo.png') }}"  alt="" class="rounded-circle" />
{{--            <p><strong>Hệ thống giám sát ao nuôi thủy sản</strong></p>--}}
{{--            <span class="text-primary small"><strong>Sử dụng các bộ kit đo của IoT Arduino</strong></span>--}}
            <p class="text-primary small"><strong style="font-size: 18px">Hệ thống giám sát ao nuôi</strong></p>
        </div>
        <!--Image Avatar-->

        <!--Sidebar Navigation Menu-->
            <div class="sidebar-menu-container">
                <ul class="sidebar-menu mt-4 mb-4">
                    <li class="parent">
                        <a href="{{route('homeUs')}}" class=""><i class="fas fa-home mr-3"></i>
                            <span class="none">Trang chủ</span>
                        </a>
                    </li>
                    <li class="parent">
                        <a href="{{route('pondConfig')}}" class=""><i class="fas fa-user-cog mr-3"></i>
                            <span class="none">Cài đặt ao nuôi</span>
                        </a>
                    </li>
                    <li class="parent">
                        <a href="{{route('configToolkit')}}" class=""><i class="fas fa-user-cog mr-3"></i>
                            <span class="none">Cài đặt bộ đo </span>
                        </a>
                    </li>
                    <li class="parent">
                        <a href="{{route('configControl')}}" class=""><i class="fas fa-user-cog mr-3"></i>
                            <span class="none">Cài đặt bộ điều khiển</span>
                        </a>
                    </li>
                </ul>
            </div>
    <!--Sidebar Naigation Menu-->
    </div>
</div>

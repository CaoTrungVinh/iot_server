<div class="col-sm-3 col-xs-6 sidebar pl-0">
    <div class="inner-sidebar mr-3">
        <!--Image Avatar-->
        <div class="avatar text-center">
            <img src="assets/img/client-img4.png" alt="" class="rounded-circle" />
            <p><strong>Jonathan Clarke</strong></p>
            <span class="text-primary small"><strong>UI/UX Designer</strong></span>
        </div>
        <!--Image Avatar-->

        <!--Sidebar Navigation Menu-->
        <div class="sidebar-menu-container">
            <ul class="sidebar-menu mt-4 mb-4">
                <li class="parent">
                    <a href="{{route('home')}}" class=""><i class="fa fa-dashboard mr-3"></i>
                        <span class="none">Dashboard </span>
                    </a>
                </li>
                <li class="parent">
                    <a href="widgets.html" class=""><i class="fa fa-puzzle-piece mr-3"></i>
                        <span class="none">Widget </span>
                    </a>
                </li>
                <li class="parent">
                    <a href="#" onclick="toggle_menu('ul_element'); return false" class=""><i class="fa fa-puzzle-piece mr-3"></i>
                        <span class="none">UI Elements <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                    </a>
                    <ul class="children" id="ul_element">
                        <li class="child"><a href="accordion.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Accordions</a></li>
                        <li class="child"><a href="buttons.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Buttons</a></li>
                        <li class="child"><a href="badges.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Badges</a></li>
                        <li class="child"><a href="breadcrumb.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Breadcrumbs</a></li>
                        <li class="child"><a href="cards.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Cards</a></li>
                        <li class="child"><a href="icons.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Icons</a></li>
                        <li class="child"><a href="modal.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Modals</a></li>
                        <li class="child"><a href="notification.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Notification</a></li>
                        <li class="child"><a href="progressbar.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Progressbar</a></li>
                        <li class="child"><a href="sweetalert.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Sweet alert</a></li>
                        <li class="child"><a href="tabs.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Tabs</a></li>
                        <li class="child"><a href="tooltip-popover.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Tooltip and Popovers</a></li>
                        <li class="child"><a href="typography.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Typography</a></li>
                    </ul>
                </li>
                <li class="parent">
                    <a href="#" onclick="toggle_menu('form_element'); return false" class=""><i class="fa fa-pencil-square mr-3"></i>
                        <span class="none">Form Elements <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                    </a>
                    <ul class="children" id="form_element">
                        <li class="child"><a href="form-general.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Basic Elements</a></li>
                        <li class="child"><a href="form-advanced.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Advanced Elements</a></li>
                        <li class="child"><a href="form-validation.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Validation</a></li>
                        <li class="child"><a href="form-wizard.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Form Wizard</a></li>
                    </ul>
                </li>
                <li class="parent">
                    <a href="#" onclick="toggle_menu('editors'); return false" class=""><i class="fa fa-pencil-square-o mr-3"></i>
                        <span class="none">Text Editors <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                    </a>
                    <ul class="children" id="editors">
                        <li class="child"><a href="ckeditor-classic.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Ckeditor classic</a></li>
                        <li class="child"><a href="ckeditor-inline.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Ckeditor inline</a></li>
                        <li class="child"><a href="ckeditor-document.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Ckeditor document</a></li>
                        <li class="child"><a href="summernote.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Summernote editor</a></li>
                    </ul>
                </li>
                <li class="parent">
                    <a href="#" onclick="toggle_menu('tables'); return false" class=""><i class="fa fa-pencil-square mr-3"></i>
                        <span class="none">Tables <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                    </a>
                    <ul class="children" id="tables">
                        <li class="child"><a href="basic-tables.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Basic Tables</a></li>
                        <li class="child"><a href="datatable.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Datatables</a></li>
                        <li class="child"><a href="jsgrid-table.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> JSGrid Tables</a></li>
                    </ul>
                </li>
                <li class="parent">
                    <a href="#" onclick="toggle_menu('charts'); return false" class=""><i class="fa fa-pie-chart mr-3"></i>
                        <span class="none">Charts <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                    </a>
                    <ul class="children" id="charts">
                        <li class="child"><a href="chart.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Chart JS</a></li>
                        <li class="child"><a href="chartist.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Chartist JS</a></li>
                        <li class="child"><a href="echarts.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Echarts JS</a></li>
                        <li class="child"><a href="flot.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Flot JS</a></li>
                        <li class="child"><a href="morris.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Morris JS</a></li>
                        <li class="child"><a href="nvd3.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> NVD3 JS</a></li>
                        <li class="child"><a href="sparkline.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Sparkline JS</a></li>
                    </ul>
                </li>
                <li class="parent">
                    <a href="icons.html" class=""><i class="fa fa-toggle-on mr-3"></i>
                        <span class="none">Icons</span>
                    </a>
                </li>
                <li class="parent">
                    <a href="#" onclick="toggle_menu('ecommerce'); return false" class=""><i class="fa fa-shopping-cart mr-3"></i>
                        <span class="none">Ecommerce <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                    </a>
                    <ul class="children" id="ecommerce">
                        <li class="child"><a href="products.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> ProductList</a></li>
                        <li class="child"><a href="product-detail.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> ProductDetail</a></li>
                        <li class="child"><a href="orders.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> OrderList</a></li>
                        <li class="child"><a href="invoice.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Invoice</a></li>
                    </ul>
                </li>
                <li class="parent">
                    <a href="#" onclick="toggle_menu('maps'); return false" class=""><i class="fa fa-map mr-3"></i>
                        <span class="none">Maps <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                    </a>
                    <ul class="children" id="maps">
                        <li class="child"><a href="jvector-maps.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Jvector Maps</a></li>
                        <li class="child"><a href="google-maps.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Google Maps</a></li>
                    </ul>
                </li>
                <li class="parent">
                    <a href="#" onclick="toggle_menu('pages'); return false" class=""><i class="fa fa-file mr-3"></i>
                        <span class="none">Pages <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                    </a>
                    <ul class="children" id="pages">
                        <li class="child"><a href="email-inbox.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Email-Inbox</a></li>
                        <li class="child"><a href="email.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Email-Compose</a></li>
                        <li class="child"><a href="login.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Login</a></li>
                        <li class="child"><a href="register.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Signup</a></li>
                        <li class="child"><a href="lockscreen.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Lock Screen</a></li>
                        <li class="child"><a href="forgot-password.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Forgot Password</a></li>
                        <li class="child"><a href="profile.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Profile</a></li>
                        <li class="child"><a href="gallery.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Gallery</a></li>
                        <li class="child"><a href="invoice.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Invoice</a></li>
                        <li class="child"><a href="search-result.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Search</a></li>
                        <li class="child"><a href="pricing.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Pricing</a></li>
                        <li class="child"><a href="blank.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Blank Page</a></li>
                        <li class="child"><a href="error-404.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Error 404</a></li>
                        <li class="child"><a href="error-500.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Error 500</a></li>
                        <li class="child"><a href="error-504.html" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Error 504</a></li>
                    </ul>
                </li>
                <li class="parent">
                    <a href="fullcalendar.html" class=""><i class="fa fa-calendar-o mr-3"> </i>
                        <span class="none">Full Calendar </span>
                    </a>
                </li>
            </ul>
        </div>
        <!--Sidebar Naigation Menu-->
    </div>
</div>
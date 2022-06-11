<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li class=" menu-title text-warning">Chính</li>

                @can('lend-list')
                    <li @yield('lend')>
                        <a href="{{route('administrator.lends.index')}}" class="waves-effect">
                            <i class="mdi mdi-cube-outline"></i>
                            <span> Hợp đồng </span>
                        </a>
                    </li>
                @endcan

                @can('user-list')
                    <li @yield('user')>
                        <a href="{{route('administrator.users.index')}}" class="waves-effect">
                            <i class="mdi mdi-cube-outline"></i>
                            <span> Khách hàng </span>
                        </a>
                    </li>
                @endcan

                <li class=" menu-title text-warning">Quản lý trang</li>

                @can('logo-list')
                    <li @yield('logo')>
                        <a href="{{route('administrator.logo.add')}}" class="waves-effect">
                            <i class="mdi mdi-cube-outline"></i>
                            <span> Logo </span>
                        </a>
                    </li>
                @endcan

                @can('slider-list')
                    <li @yield('slider')>
                        <a href="{{route('administrator.slider.index')}}" class="waves-effect">
                            <i class="mdi mdi-cube-outline"></i>
                            <span> Slider </span>
                        </a>
                    </li>
                @endcan

                <li class=" menu-title text-warning">Phân quyền</li>

                @can('employee-list')
                    <li @yield('employee')>
                        <a href="{{route('administrator.employees.index' , ['start' => date("Y-m-01", strtotime(date("Y-m-d"))), "end" => date("Y-m-t", strtotime(date("Y-m-d")))])}}"
                           class="waves-effect">
                            <i class="mdi mdi-cube-outline"></i>
                            <span>Nhân viên</span>
                        </a>
                    </li>
                @endcan

                @can('role-list')
                    <li @yield('role')>
                        <a href="{{route('administrator.roles.index')}}" class="waves-effect">
                            <i class="mdi mdi-cube-outline"></i>
                            <span>Vai trò</span>
                        </a>
                    </li>
                @endcan

                <li class=" menu-title text-warning">More</li>

                @can('history-data-list')
                    <li @yield('history_data')>
                        <a href="{{route('administrator.history_data.index')}}" class="waves-effect">
                            <i class="mdi mdi-cube-outline"></i>
                            <span>Lịch sử dữ liệu</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

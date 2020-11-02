<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}"
             alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}"
                     class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $viewModel->admin->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"
                role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview
                    {{ $viewModel->activeGroup === 'dashboard' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $viewModel->activeGroup === 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.home') }}"
                               class="nav-link {{ $viewModel->active === 'admin.home' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2
                                    <span class="right badge badge-success">200</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
{{--                <li class="nav-item has-treeview {{ $nav == 'customer' ? 'menu-open' : '' }}">--}}
                    <a href="#" class="nav-link">
{{--                    <a href="#" class="nav-link {{ $nav == 'customer' ? 'active' : '' }}">--}}
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Customers
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="{{ route('customers.index') }}"--}}
                        {{--                               class="nav-link {{ $subNav == 'customer-index' ? 'active' : '' }}">--}}
                        {{--                                <i class="far fa-circle nav-icon"></i>--}}
                        {{--                                <p>List Customers</p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="{{ route('customers.create') }}"--}}
                        {{--                               class="nav-link {{ $subNav == 'admin-create' ? 'active' : '' }}">--}}
                        {{--                                <i class="far fa-circle nav-icon"></i>--}}
                        {{--                                <p>Add Customer</p>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ $viewModel->activeGroup === 'admin' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $viewModel->activeGroup === 'admin' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Admins
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.list') }}"
                               class="nav-link
                               {{ $viewModel->active === 'admin.list' ? 'active' : '' }}
                               {{ $viewModel->canList ? '' : 'disabled' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Admins
                                    @if(!$viewModel->canList)
                                        <span class="right badge badge-danger">403</span>
                                    @else
                                        <span class="right badge badge-success">200</span>
                                    @endif
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.register') }}"
                               class="nav-link
                               {{ $viewModel->canRegister ? '' : 'disabled' }}
                               {{ $viewModel->active === 'admin.register' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Register Admin
                                    @if(!$viewModel->canRegister)
                                        <span class="right badge badge-danger">403</span>
                                    @else
                                        <span class="right badge badge-success">200</span>
                                    @endif
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"
                               class="nav-link disabled
                               {{ $viewModel->active === 'admin.password.reset' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reset Password
                                    @if ($viewModel->active === 'admin.password.reset')
                                        <span class="right badge badge-info">{{ 'ID ' . $viewModel->adminItem->id }}</span>
                                    @else
                                        <span class="right badge badge-danger">ID NO</span>
                                    @endif
                                </p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="#"--}}
{{--                               class="nav-link ">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Change Role</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">EXAMPLES</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Calendar
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Pages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>E-commerce</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Projects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Edit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Detail</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contacts</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>

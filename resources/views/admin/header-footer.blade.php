<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mal-Gari Admin</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.min.css') }}">

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatablenew/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatablenew/responsive.dataTables.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">
    <!-- Toatr CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/toastr/toatr.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('admin-assets/js/jquery-3.6.0.min.js') }}"></script>
</head>

<body>

    <div class="main-wrapper">
        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="{{ url('/admin/dashbord') }}" class="logo ">
                    <img src="{{ asset('/images/settings/logo.png') }}" alt=""> <span class="text-dark">Mal-Gari
                        Admin</span>
                    {{-- <h5 class="text-dark">Admin Section</h5> --}}
                </a>
                <a href="{{ url('/admin/dashbord') }}" class="logo logo-small">
                    <img src="{{ asset('/images/settings/logo.png') }}" alt="">
                    {{-- <h5 class="text-dark">Admin Section</h5> --}}
                </a>
            </div>
            <!-- /Logo -->

            <!-- Sidebar Toggle -->
            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fas fa-bars"></i>
            </a>
            <!-- /Sidebar Toggle -->

            <!-- Mobile Menu Toggle -->
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>
            <!-- /Mobile Menu Toggle -->

            <!-- Header Menu -->
            <ul class="nav nav-tabs user-menu">

                <!-- User Menu -->
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        {{-- <p class="fa fa-user"></p> --}}
                        <span class="user-img">
                            @if (Auth::check())
                                <img src="{{ File::exists('images/user/' . Auth::user()->user_details->img) ? asset('images/user/' . Auth::user()->user_details->img) : '' }}"
                                    alt="">
                            @endif
                        </span>
                        <span>
                            @if (Auth::check())
                                {{ Auth::user()->last_name }}
                            @endif
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('/admin/profile') }}"><i data-feather="user"
                                class="me-1"></i>
                            Profile</a>
                        <a class="dropdown-item" href="{{ url('/admin/settings') }}"><i data-feather="settings"
                                class="me-1"></i> Settings</a>
                        <a class="dropdown-item" href="{{ url('/admin/logout') }}"><i data-feather="log-out"
                                class="me-1"></i>
                            Logout</a>
                    </div>
                </li>
                <!-- /User Menu -->
            </ul>
            <!-- /Header Menu -->

        </div>
        <!-- /Header -->

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title"><span>Options</span></li>
                        <hr>
                        <li class="{{ Request::is('admin/dashbord') ? 'active' : '' }}">
                            <a href="{{ url('/admin/dashbord') }}"><i data-feather="home"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li class="submenu">
                            <a class="{{ Request::is('admin/profile', 'admin/edituser', 'admin/adminlist') ? 'active' : '' }}"
                                href="#"><i data-feather="user"></i> <span> Admin</span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="ms-4">
                                @if (Auth::check())
                                    <li class="{{ Request::is('admin/userprofile') ? 'active' : '' }}">
                                        <a href="{{ url('/admin/userprofile/' . Auth::user()->id) }}"><i
                                                class="fa fa-user-circle "></i>
                                            Admin Profile</a>
                                    </li>
                                @endif
                                @if (Auth::check())
                                    <li
                                        class="{{ Request::is('admin/edituser/' . Auth::user()->id) ? 'active' : '' }}">
                                        <a href="{{ url('/admin/edituser/' . Auth::user()->id) }}"><i
                                                class="fa fa-pen"></i>
                                            Edit Profile</a>
                                    </li>
                                @endif
                                <li class="{{ Request::is('admin/adduser') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/adduser') }}"><i class="fa fa-user-plus"></i> Add Admin</a>
                                </li>
                                <li class="{{ Request::is('admin/adminlist') ? 'active' : '' }}">
                                    <a href="{{ url('admin/adminlist') }}"><i class="fa fa-users"></i> Admin List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a class="{{ Request::is('admin/addseller', 'admin/sellerlist') ? 'active' : '' }}"
                                href="#"><i data-feather="user"></i> <span> Seller</span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="ms-4">
                                <li class="{{ Request::is('admin/addseller') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/adduser') }}"><i class="fa fa-user-plus"></i> Add
                                        Seller</a>
                                </li>
                                <li class="{{ Request::is('admin/sellerlist') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/sellerlist') }}"><i class="fa fa-users"></i> Seller
                                        List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a class="{{ Request::is('buyer/profile', 'admin/buyerlist') ? 'active' : '' }}"
                                href="#"><i data-feather="user"></i> <span> Buyer</span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="ms-4">
                                <li class="{{ Request::is('buyer/profile') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/adduser') }}"><i class="fa fa-user-plus"></i> Add
                                        Buyer</a>
                                </li>
                                <li class="{{ Request::is('admin/buyerlist') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/buyerlist') }}"><i class="fa fa-users"></i> Buyer
                                        List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a class="{{ Request::is('rider/profile', 'admin/riderlist') ? 'active' : '' }}"
                                href="#"><i data-feather="user"></i> <span> Rider</span> <span
                                    class="menu-arrow"></span></a>
                            <ul class="ms-4">
                                <li class="{{ Request::is('/admin/adduser') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/adduser') }}"><i class="fa fa-user-plus"></i> Add
                                        Rider</a>
                                </li>
                                <li class="{{ Request::is('admin/riderlist') ? 'active' : '' }}">
                                    <a href="{{ url('/admin/riderlist') }}"><i class="fa fa-users"></i> Rider
                                        List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{ Request::is('admin/adduser') ? 'active' : '' }}">
                            <a href="{{ url('/admin/adduser') }}"><i data-feather="user-plus"></i> <span> Add New
                                    User</span></a>
                        </li>
                        <li class="{{ Request::is('admin/product-list') ? 'active' : '' }}">
                            <a href="{{ url('/admin/product-list') }}"><i class="fa fa-list"></i><span>Product List</span></a>
                        </li>
                        <li class="{{ Request::is('admin/bid') ? 'active' : '' }}">
                            <a href="{{ url('/admin/bid') }}"><i class="fa fa-gavel"></i><span>Bids</span></a>
                        </li>
                        <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                            <a href="{{ url('/admin/settings') }}"><i data-feather="settings"></i>
                                <span>Settings</span></a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
        <!-- /Sidebar -->

        <div class="page-wrapper">
            <div class="content container-fluid">
                @yield('admin_content')
            </div>
        </div>

    </div>





    <!-- Bootstrap Core JS -->
    <script src="{{ asset('admin-assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/bootstrap.min.js') }}"></script>

    <!-- Feather Icon JS -->
    <script src="{{ asset('admin-assets/js/feather.min.js') }}"></script>

    <!-- Slimscroll JS -->
    <script src="{{ asset('admin-assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Datatables JS -->
    <script src="{{ asset('admin-assets/plugins/datatablenew/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatablenew/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatablenew/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/datatablenew/dataTables.responsive.min.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('admin-assets/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Mask JS -->
    <script src="{{ asset('admin-assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/toastr/toastr.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('admin-assets/js/script.js') }}"></script>

    <!-- Sweetalert 2 -->
    <script src="{{ asset('admin-assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('table').DataTable({
                "paging": true,
                "responsive": true
            });
        });
    </script>
</body>

</html>

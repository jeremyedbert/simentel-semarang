<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.admin-header')
    <style>
        .hover-notif {
            cursor: pointer;
        }
    </style>
</head>

<body onload="initialize()">
    <script src={{ url('assets/admin/js/core/jquery.3.2.1.min.js') }}></script>
    <script src={{ url('assets/admin/js/core/popper.min.js') }}></script>
    <script src={{ url('assets/admin/js/core/bootstrap.min.js') }}></script>

    <!-- jQuery UI -->
    <script src={{ url('assets/admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}></script>
    <script src={{ url('assets/admin/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}></script>

    <!-- jQuery Scrollbar -->
    <script src={{ url('assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}></script>

    <!-- Moment JS -->
    <script src={{ url('assets/admin/js/plugin/moment/moment.min.js') }}></script>

    <!-- Chart JS -->
    <script src={{ url('assets/admin/js/plugin/chart.js/chart.min.js') }}></script>

    <!-- jQuery Sparkline -->
    <script type="text/javascript" src={{ url('assets/admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}>
    </script>

    <!-- Chart Circle -->
    <script src={{ url('assets/admin/js/plugin/chart-circle/circles.min.js') }}></script>

    <!-- Datatables -->
    <script type="text/javascript" src={{ url('assets/admin/js/plugin/datatables/datatables.min.js') }}></script>

    <!-- Bootstrap Notify -->
    <script src={{ url('assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}></script>

    <!-- Bootstrap Toggle -->
    <script src={{ url('assets/admin/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}></script>

    <!-- jQuery Vector Maps -->
    <script src={{ url('assets/admin/js/plugin/jqvmap/jquery.vmap.min.js') }}></script>
    <script src={{ url('assets/admin/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}></script>

    <!-- Google Maps Plugin -->
    <script src={{ url('assets/admin/js/plugin/gmaps/gmaps.js') }}></script>

    <!-- Sweet Alert -->
    <script src={{ url('assets/admin/js/plugin/sweetalert/sweetalert.min.js') }}></script>

    <!-- Azzara JS -->
    <script src={{ url('assets/admin/js/ready.min.js') }}></script>

    <div class="wrapper">
        <!--
   Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
  -->
        <div class="main-header" data-background-color="blue">
            <!-- Logo Header -->
            <div class="logo-header">
                {{-- <div> --}}
                <a href="/admin/dashboard" style="text-align: center" class="logo">
                    <img style="width: 60%" src={{ url('assets/admin/img/logosimentel.png') }} alt="navbar brand"
                        class="navbar-brand">
                </a>
                {{-- </div> --}}
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-bars"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
                <div class="navbar-minimize">
                    <button class="btn btn-minimize btn-rounded">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg">

                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        {{-- <li class="nav-item toggle-nav-search hidden-caret">
                            <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button"
                                aria-expanded="false" aria-controls="search-nav">
                                <i class="fa fa-search"></i>
                            </a>
                        </li> --}}
                        <li class="nav-item dropdown hidden-caret submenu">
                            {{-- <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                @if ($countNotif > 0)
                                    <span class="notification">{{ $countNotif }}</span>
                                @endif
                            </a> --}}
                            <ul class="dropdown-menu notif-box" aria-labelledby="notifDropdown">
                                {{-- <li>
                                    <div class="dropdown-title">You have 4 new notification</div>
                                </li> --}}
                                <li>
                                    <div class="scroll-wrapper notif-scroll scrollbar-outer"
                                        style="position: relative;">
                                        <div class="notif-scroll scrollbar-outer scroll-content"
                                            style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 256px;">
                                            <div class="notif-center submenu">
                                                @foreach ($notif as $n)
                                                    <form action="/admin/notifikasi/{{ $n->id }}" method="post">
                                                        @csrf
                                                        <button class="hover-notif" type="submit"
                                                            style="width: 100%; border: 0; background: {{ $n->pendaftaran->status_id == 1 ? '#FFFBDE' : '#FFFFFF' }}">
                                                            {{-- <div class="notif-icon notif-primary">
                                                            <i class="fa fa-user-plus"></i>
                                                        </div> --}}
                                                            <a class="d-flex"
                                                                style="background: {{ $n->pendaftaran->status_id == 1 ? '#FFFBDE' : '#FFFFFF' }}">
                                                                <div class="notif-content" style="width: 100%">
                                                                    <span class="block ml-3">
                                                                        <b>{{ $n->pendaftaran->tower->idMenara }}</b>
                                                                    </span>
                                                                    <span
                                                                        class="time ml-3">{{ $n->created_at->diffForHumans() }}</span>
                                                                </div>
                                                            </a>
                                                        </button>
                                                    </form>
                                                @endforeach
                                                {{-- <a href="#">
                                                    <div class="notif-icon notif-success"> <i
                                                            class="fa fa-comment"></i> </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            Rahmad commented on Admin
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-icon notif-danger"> <i class="fa fa-heart"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            Farrah liked Admin
                                                        </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a> --}}
                                            </div>
                                        </div>
                                        <div class="scroll-element scroll-x" style="">
                                            <div class="scroll-element_outer">
                                                <div class="scroll-element_size"></div>
                                                <div class="scroll-element_track"></div>
                                                <div class="scroll-bar ui-draggable ui-draggable-handle"
                                                    style="width: 100px;"></div>
                                            </div>
                                        </div>
                                        <div class="scroll-element scroll-y" style="">
                                            <div class="scroll-element_outer">
                                                <div class="scroll-element_size"></div>
                                                <div class="scroll-element_track"></div>
                                                <div class="scroll-bar ui-draggable ui-draggable-handle"
                                                    style="height: 100px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                {{-- <li class="submenu">
                                    <a class="see-all" href="javascript:void(0);">See all notifications<i
                                            class="fa fa-angle-right"></i> </a>
                                </li> --}}
                            </ul>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src={{ url('assets/admin/img/profile.png') }} alt="..."
                                        class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg"><img
                                                src={{ url('assets/admin/img/profile.png') }} alt="image profile"
                                                class="avatar-img rounded"></div>
                                        <div class="u-text">
                                            <h4>{{ auth()->user()->name }}</h4>
                                            <p class="text-muted">{{ auth()->user()->email }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <form action="/admin/logout" method="post">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        @include('partials.admin-sidebar')
        <!-- End Sidebar -->

        @yield('content')
    </div>
    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.user-header')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
</head>

<body id="top">

    <header>
        <nav class="navbar navbar-expand-lg navigation shadow-sm" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="images/logo.png" alt="" class="img-fluid">
                </a>

                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain"
                    aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icofont-navigation-menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarmain">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"><a class="nav-link"
                                href="{{ route('home') }}">Beranda</a></li>

                        <li
                            class="nav-item dropdown {{ Request::is('user/peta-menara') || Request::is('user/peta-microcell') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" id="dropdownpeta" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Peta<i class="icofont-thin-down"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownpeta">
                                <li><a class="dropdown-item" href="/user/peta-menara">Peta Menara</a></li>
                                <li><a class="dropdown-item" href="/user/peta-microcell">Peta Microcell</a>
                                </li>
                            </ul>
                        </li>


                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="dropdownuser" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Halo, {{ auth()->user()->name }}<i
                                        class="icofont-thin-down"></i></a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownuser">
                                    {{-- <li><a class="dropdown-item" href="/user/cekstatus">Cek Status Permohonan</a></li> --}}
                                    <li><a class="dropdown-item" href="/user/edit">Edit Profil</a></li>
                                    <li>
                                        <form action="/user/logout" method="post">
                                            @csrf
                                            <button class="dropdown-item" type="submit">Log Out</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li
                                class="nav-item dropdown {{ Request::is('user/login') || Request::is('admin/login') || Request::is('user/register') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" id="dropdownlogin" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Login <i class="icofont-thin-down"></i></a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownlogin">
                                    <li><a class="dropdown-item" href="{{ route('user.login') }}">Login sebagai
                                            Pemohon</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.login') }}">Login sebagai
                                            Admin</a></li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- File Pond -->
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <!-- Slider Start -->

    <section class="mt-4">
        <div class="d-flex row d-inline-block mb-5">
            <div class="col-lg-8 mx-auto" style=" min-height: 80vh ">
                <div class="col-lg-11 pl-lg-0">
                    <h2 class="title-color mb-2">Verifikasi Email Anda</h2>
                    <div class="divider mb-4"></div>
                    <div class="detail">
                        <div class="col-lg-12 shadow py-4 mb-3" style="border-radius: 7px;">
                            <div class="mx-3 mb-4 pb-2">
                                @if (session('resent'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Pesan verifikasi sudah dikirimkan. Silakan lihat kotak masuk Anda.
                                    </div>
                                @endif
                                Untuk melakukan pendaftaran menara, Anda perlu melakukan verifikasi email.
                                <form class="d-inline" method="POST"
                                    action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Klik untuk
                                        mengirim pesan
                                        verifikasi</button>.
                                </form>
                                Jika Anda mengalami kesalahan pada data email, <a href="/user/edit" class="btn btn-link p-0 m-0 align-baseline">ubah email</a> Anda.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer Start -->
        @include('partials.user-footer')
        <!-- 
    Essential Scripts
    =====================================-->
        <script src="{{ url('assets/user/plugins/jquery/jquery.js') }}"></script>
        <script src="{{ url('assets/user/plugins/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ url('assets/user/plugins/slick-carousel/slick/slick.min.js') }}"></script>
        <script src="{{ url('assets/user/plugins/shuffle/shuffle.min.js') }}"></script>

        <!-- Google Map -->
        {{-- <script src="assets/user/plugins/google-map/gmap.js"></script> --}}

        <script src="{{ url('assets/user/js/script.js') }}"></script>

</body>

</html>

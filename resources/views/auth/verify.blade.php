<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.user-header')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
</head>

<body id="top">

    <header>
        <nav class="navbar navbar-expand-lg navigation" id="navbar">
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
    <div class="container pb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Verifikasi Email Anda</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                Pesan verifikasi sudah dikirimkan. Silakan lihat kotak masuk Anda.
                            </div>
                        @endif
                        Sebelum melanjutkan, silakan cek kotak masuk email Anda untuk link verifikasi.
                        Jika belum mendapat pesan,
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">klik untuk mengirim
                                kembali</button>.
                        </form>
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

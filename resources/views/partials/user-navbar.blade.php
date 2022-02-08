{{-- <div class="header-top-bar">
    <div class="container">
        <div class="row align-items-center">
            <ul class="top-bar-info list-inline-item pl-0 mb-0">
                <li class="list-inline-item mr-4"><i class="icofont-email mr-2"></i> simentel@semarangkota.go.id</li>
                <li class="list-inline-item mr-4"><i class="icofont-location-pin mr-2"></i>Jl. Pemuda No.148, Semarang 50132
                </li>
                <li class="list-inline-item mr-4"><i class="icofont-ui-call mr-2"></i>
                    (024) 3513366
                </li>

            </ul>
        </div>
    </div>
</div> --}}
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
                <li class="nav-item {{ Request::is('user/daftar-menara') ? 'active' : '' }}"><a class="nav-link"
                        {{-- href="{{ route('user.daftar-menara') }}">Pendaftaran</a></li> --}}
                        href="/user/daftar-menara">Pendaftaran</a></li>

                <li class="nav-item dropdown  {{ Request::is('user/peta-menara') OR Request::is('user/peta-microcell') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" id="dropdownpeta" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Peta<i class="icofont-thin-down"></i></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownpeta">
                        <li><a class="dropdown-item" href="{{ route('user.peta-menara') }}">Peta Menara</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.peta-microcell') }}">Peta Microcell</a></li>
                    </ul>
                </li>
                

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdownuser" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Halo, {{ auth()->user()->name }}<i
                                class="icofont-thin-down"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownuser">
                            <li><a class="dropdown-item" href="/user/cekstatus">Cek Status Permohonan</a></li>
                            <li>
                                <form action="/user/logout" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item dropdown  {{ $active === 'login' ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" id="dropdownlogin" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Login <i class="icofont-thin-down"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownlogin">
                            <li><a class="dropdown-item" href="{{ route('user.login') }}">Login sebagai Pemohon</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.login') }}">Login sebagai Admin</a></li> 
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

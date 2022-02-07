<div class="sidebar">

    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav">
                <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href='/admin/dashboard'>
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="badge badge-count">5</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/pendaftaran*') ? 'active' : '' }}">
                    <a href="/admin/pendaftaran">
                        <i class="fas fa-file-alt"></i>
                        <p>Permohonan</p>
                        {{-- <span class="badge badge-count badge-success">4</span> --}}
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/menara*') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#peta">
                        <i class="fas fa-broadcast-tower"></i>
                        <p>Menara</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="peta">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/admin/menara/makro">
                                    <span class="sub-item">Menara Utama</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/menara/mikro">
                                    <span class="sub-item">Menara Mikro</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::is('admin/riwayat*') ? 'active' : '' }}">
                    <a href="/admin/riwayat">
                        <i class="fas fa-history"></i>
                        <p>Riwayat</p>
                        {{-- <span class="badge badge-count badge-success">4</span> --}}
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Forms</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Basic Form</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Tables</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Basic Table</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#maps">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Maps</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="maps/googlemaps.html">
                                    <span class="sub-item">Google Maps</span>
                                </a>
                            </li>
                            <li>
                                <a href="maps/fullscreenmaps.html">
                                    <span class="sub-item">Full Screen Maps</span>
                                </a>
                            </li>
                            <li>
                                <a href="maps/jqvmap.html">
                                    <span class="sub-item">JQVMap</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Charts</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">Chart Js</span>
                                </a>
                            </li>
                            <li>
                                <a href="charts/sparkline.html">
                                    <span class="sub-item">Sparkline</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="widgets.html">
                        <i class="fas fa-desktop"></i>
                        <p>Widgets</p>
                        <span class="badge badge-count badge-success">4</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#custompages">
                        <i class="fas fa-paint-roller"></i>
                        <p>Custom Pages</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="custompages">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="login.html">
                                    <span class="sub-item">Login & Register 1</span>
                                </a>
                            </li>
                            <li>
                                <a href="login2.html">
                                    <span class="sub-item">Login & Register 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="userprofile.html">
                                    <span class="sub-item">User Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="404.html">
                                    <span class="sub-item">404</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#submenu">
                        <i class="fas fa-bars"></i>
                        <p>Menu Levels</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</div>

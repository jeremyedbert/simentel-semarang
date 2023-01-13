@extends('layouts.main-admin')
@section('content')
    {{-- <script src={{ url('assets/admin/js/plugin/chart.js/chart.min.js') }}></script> --}}
    <style>
        .notif {
            position: absolute;
            background-color: #f3545d;
            text-align: center;
            border-radius: 20px;
            min-width: 25px;
            height: 25px;
            font-size: 16px;
            color: #ffffff;
            font-weight: 300;
            line-height: 24px;
            top: -6px;
            right: -6px;
            letter-spacing: -1px;
        }

    </style>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h1 style="color: black" class="pb-3"><b>Dashboard</b></h1>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-stats card-round">
                            {{-- @if ($notif->count())
                                <span class="notif">{{ $notif->count() }}</span>
                            @endif --}}
                            <div class="card-body ">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                                            <i class="fas fa-list-ul"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <h3 class="fw-bold">Pendaftaran</h3>
                                            <h4>{{ $apply->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <h2 class="fw-bold">Diterima</h2>
                                            <h4>{{ $acc->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-danger bubble-shadow-small">
                                            <i class="fas fa-times"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <h2 class="fw-bold">Ditolak</h2>
                                            <h4>{{ $reject->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="card card-stats card-primary card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-broadcast-tower"></i>
                                        </div>
                                    </div>
                                    <a href="/admin/menara/makro" style="text-decoration: none; color: white">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <div class="numbers">
                                                <h2 class="fw-bold">Menara Makro</h2>
                                                <h4>{{ $makro->count() }} Menara</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="card card-stats card-secondary card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                            <i class="fas fa-broadcast-tower"></i>
                                        </div>
                                    </div>
                                    <a href="/admin/menara/mikro" style="text-decoration: none; color: white">
                                        <div class="col col-stats ml-3 ml-sm-0">
                                            <div class="numbers">
                                                {{-- <p class="card-category">Sales</p> --}}
                                                <h2 class="fw-bold">Menara Mikro</h2>
                                                <h4>{{ $mikro->count() }} Menara</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Grafik Jumlah Menara</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container" style="min-height: 375px">
                                    <canvas id="barChart"></canvas>
                                </div>
                                <div id="myChartLegend"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row row-card-no-pd">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <h4 class="card-title">Users Geolocation</h4>
                                    <div class="card-tools">
                                        <button class="btn btn-icon btn-link btn-primary btn-xs"><span
                                                class="fa fa-angle-down"></span></button>
                                        <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"><span
                                                class="fa fa-sync-alt"></span></button>
                                        <button class="btn btn-icon btn-link btn-primary btn-xs"><span
                                                class="fa fa-times"></span></button>
                                    </div>
                                </div>
                                <p class="card-category">
                                    Map of the distribution of users around the world</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="table-responsive table-hover table-sales">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../assets/admin/img/flags/id.png" alt="indonesia">
                                                            </div>
                                                        </td>
                                                        <td>Indonesia</td>
                                                        <td class="text-right">
                                                            2.320
                                                        </td>
                                                        <td class="text-right">
                                                            42.18%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../assets/admin/img/flags/us.png"
                                                                    alt="united states">
                                                            </div>
                                                        </td>
                                                        <td>USA</td>
                                                        <td class="text-right">
                                                            240
                                                        </td>
                                                        <td class="text-right">
                                                            4.36%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../assets/admin/img/flags/au.png" alt="australia">
                                                            </div>
                                                        </td>
                                                        <td>Australia</td>
                                                        <td class="text-right">
                                                            119
                                                        </td>
                                                        <td class="text-right">
                                                            2.16%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../assets/admin/img/flags/ru.png" alt="russia">
                                                            </div>
                                                        </td>
                                                        <td>Russia</td>
                                                        <td class="text-right">
                                                            1.081
                                                        </td>
                                                        <td class="text-right">
                                                            19.65%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../assets/admin/img/flags/cn.png" alt="china">
                                                            </div>
                                                        </td>
                                                        <td>China</td>
                                                        <td class="text-right">
                                                            1.100
                                                        </td>
                                                        <td class="text-right">
                                                            20%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="flag">
                                                                <img src="../assets/admin/img/flags/br.png" alt="brazil">
                                                            </div>
                                                        </td>
                                                        <td>Brasil</td>
                                                        <td class="text-right">
                                                            640
                                                        </td>
                                                        <td class="text-right">
                                                            11.63%
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mapcontainer">
                                            <div id="map-example" class="vmap"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Top Products</div>
                            </div>
                            <div class="card-body pb-0">
                                <div class="d-flex">
                                    <div class="avatar">
                                        <img src="../assets/admin/img/logoproduct.svg" alt="..."
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="flex-1 pt-1 ml-2">
                                        <h5 class="fw-bold mb-1">CSS</h5>
                                        <small class="text-muted">Cascading Style Sheets</small>
                                    </div>
                                    <div class="d-flex ml-auto align-items-center">
                                        <h3 class="text-info fw-bold">+$17</h3>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="d-flex">
                                    <div class="avatar">
                                        <img src="../assets/admin/img/logoproduct2.svg" alt="..."
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="flex-1 pt-1 ml-2">
                                        <h5 class="fw-bold mb-1">J.CO Donuts</h5>
                                        <small class="text-muted">The Best Donuts</small>
                                    </div>
                                    <div class="d-flex ml-auto align-items-center">
                                        <h3 class="text-info fw-bold">+$300</h3>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="d-flex">
                                    <div class="avatar">
                                        <img src="../assets/admin/img/logoproduct3.svg" alt="..."
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="flex-1 pt-1 ml-2">
                                        <h5 class="fw-bold mb-1">Ready Pro</h5>
                                        <small class="text-muted">Bootstrap 4 Admin Dashboard</small>
                                    </div>
                                    <div class="d-flex ml-auto align-items-center">
                                        <h3 class="text-info fw-bold">+$350</h3>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="pull-in">
                                    <canvas id="topProductsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title fw-mediumbold">Suggested People</div>
                                <div class="card-list">
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="../assets/admin/img/jm_denis.jpg" alt="..."
                                                class="avatar-img rounded-circle">
                                        </div>
                                        <div class="info-user ml-3">
                                            <div class="username">Jimmy Denis</div>
                                            <div class="status">Graphic Designer</div>
                                        </div>
                                        <button class="btn btn-icon btn-primary btn-round btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="../assets/admin/img/chadengle.jpg" alt="..."
                                                class="avatar-img rounded-circle">
                                        </div>
                                        <div class="info-user ml-3">
                                            <div class="username">Chad</div>
                                            <div class="status">CEO Zeleaf</div>
                                        </div>
                                        <button class="btn btn-icon btn-primary btn-round btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="../assets/admin/img/talha.jpg" alt="..."
                                                class="avatar-img rounded-circle">
                                        </div>
                                        <div class="info-user ml-3">
                                            <div class="username">Talha</div>
                                            <div class="status">Front End Designer</div>
                                        </div>
                                        <button class="btn btn-icon btn-primary btn-round btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="../assets/admin/img/mlane.jpg" alt="..."
                                                class="avatar-img rounded-circle">
                                        </div>
                                        <div class="info-user ml-3">
                                            <div class="username">John Doe</div>
                                            <div class="status">Back End Developer</div>
                                        </div>
                                        <button class="btn btn-icon btn-primary btn-round btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="../assets/admin/img/talha.jpg" alt="..."
                                                class="avatar-img rounded-circle">
                                        </div>
                                        <div class="info-user ml-3">
                                            <div class="username">Talha</div>
                                            <div class="status">Front End Designer</div>
                                        </div>
                                        <button class="btn btn-icon btn-primary btn-round btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="item-list">
                                        <div class="avatar">
                                            <img src="../assets/admin/img/jm_denis.jpg" alt="..."
                                                class="avatar-img rounded-circle">
                                        </div>
                                        <div class="info-user ml-3">
                                            <div class="username">Jimmy Denis</div>
                                            <div class="status">Graphic Designer</div>
                                        </div>
                                        <button class="btn btn-icon btn-primary btn-round btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-primary bg-danger-gradient bubble-shadow">
                            <div class="card-body">
                                <h4 class="mt-3 b-b1 pb-2 mb-4 fw-bold">Active user right now</h4>
                                <h1 class="mb-4 fw-bold">17</h1>
                                <h4 class="mt-3 b-b1 pb-2 mb-5 fw-bold">Page view per minutes</h4>
                                <div id="activeUsersChart"></div>
                                <h4 class="mt-5 pb-3 mb-0 fw-bold">Top active pages</h4>
                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between pb-1 pt-1">
                                        <small>/product/readypro/index.html</small> <span>7</span>
                                    </li>
                                    <li class="d-flex justify-content-between pb-1 pt-1">
                                        <small>/product/azzara/demo.html</small> <span>10</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Feed Activity</div>
                            </div>
                            <div class="card-body">
                                <ol class="activity-feed">
                                    <li class="feed-item feed-item-secondary">
                                        <time class="date" datetime="9-25">Sep 25</time>
                                        <span class="text">Responded to need <a href="#">"Volunteer
                                                opportunity"</a></span>
                                    </li>
                                    <li class="feed-item feed-item-success">
                                        <time class="date" datetime="9-24">Sep 24</time>
                                        <span class="text">Added an interest <a href="#">"Volunteer
                                                Activities"</a></span>
                                    </li>
                                    <li class="feed-item feed-item-info">
                                        <time class="date" datetime="9-23">Sep 23</time>
                                        <span class="text">Joined the group <a
                                                href="single-group.php">"Boardsmanship Forum"</a></span>
                                    </li>
                                    <li class="feed-item feed-item-warning">
                                        <time class="date" datetime="9-21">Sep 21</time>
                                        <span class="text">Responded to need <a href="#">"In-Kind
                                                Opportunity"</a></span>
                                    </li>
                                    <li class="feed-item feed-item-danger">
                                        <time class="date" datetime="9-18">Sep 18</time>
                                        <span class="text">Created need <a href="#">"Volunteer
                                                Opportunity"</a></span>
                                    </li>
                                    <li class="feed-item">
                                        <time class="date" datetime="9-17">Sep 17</time>
                                        <span class="text">Attending the event <a href="single-event.php">"Some
                                                New Event"</a></span>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <div class="card-title">Support Tickets</div>
                                    <div class="card-tools">
                                        <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab"
                                            role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-today" data-toggle="pill"
                                                    href="#pills-today" role="tab" aria-selected="true">Today</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="pills-week" data-toggle="pill"
                                                    href="#pills-week" role="tab" aria-selected="false">Week</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-month" data-toggle="pill"
                                                    href="#pills-month" role="tab" aria-selected="false">Month</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="avatar avatar-online">
                                        <span class="avatar-title rounded-circle border border-white bg-info">J</span>
                                    </div>
                                    <div class="flex-1 ml-3 pt-1">
                                        <h5 class="text-uppercase fw-bold mb-1">Joko Subianto <span
                                                class="text-warning pl-3">pending</span></h5>
                                        <span class="text-muted">I am facing some trouble with my viewport.
                                            When i start my</span>
                                    </div>
                                    <div class="float-right pt-1">
                                        <small class="text-muted">8:40 PM</small>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="d-flex">
                                    <div class="avatar avatar-offline">
                                        <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                                    </div>
                                    <div class="flex-1 ml-3 pt-1">
                                        <h5 class="text-uppercase fw-bold mb-1">Prabowo Widodo <span
                                                class="text-success pl-3">open</span></h5>
                                        <span class="text-muted">I have some query regarding the license
                                            issue.</span>
                                    </div>
                                    <div class="float-right pt-1">
                                        <small class="text-muted">1 Day Ago</small>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="d-flex">
                                    <div class="avatar avatar-away">
                                        <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                                    </div>
                                    <div class="flex-1 ml-3 pt-1">
                                        <h5 class="text-uppercase fw-bold mb-1">Lee Chong Wei <span
                                                class="text-muted pl-3">closed</span></h5>
                                        <span class="text-muted">Is there any update plan for RTL version near
                                            future?</span>
                                    </div>
                                    <div class="float-right pt-1">
                                        <small class="text-muted">2 Days Ago</small>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="d-flex">
                                    <div class="avatar avatar-offline">
                                        <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                                    </div>
                                    <div class="flex-1 ml-3 pt-1">
                                        <h5 class="text-uppercase fw-bold mb-1">Peter Parker <span
                                                class="text-success pl-3">open</span></h5>
                                        <span class="text-muted">I have some query regarding the license
                                            issue.</span>
                                    </div>
                                    <div class="float-right pt-1">
                                        <small class="text-muted">2 Day Ago</small>
                                    </div>
                                </div>
                                <div class="separator-dashed"></div>
                                <div class="d-flex">
                                    <div class="avatar avatar-away">
                                        <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                                    </div>
                                    <div class="flex-1 ml-3 pt-1">
                                        <h5 class="text-uppercase fw-bold mb-1">Logan Paul <span
                                                class="text-muted pl-3">closed</span></h5>
                                        <span class="text-muted">Is there any update plan for RTL version near
                                            future?</span>
                                    </div>
                                    <div class="float-right pt-1">
                                        <small class="text-muted">2 Days Ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <script type="text/javascript">
        let barChart = document.getElementById('barChart').getContext('2d');
        let towers = @json($tower);
        let data = []
        for (tower in towers) {
            tower = towers[tower];
            data.push(tower.c);
        }
        let myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
                labels: [
                    "Smg Tengah",
                    "Smg Utara",
                    "Smg Timur",
                    "Gayamsari",
                    "Genuk",
                    "Pedurungan",
                    "Smg Selatan",
                    "Candisari",
                    "Gajahmungkur",
                    "Tembalang",
                    "Banyumanik",
                    "Gunungpati",
                    "Smg Barat",
                    "Mijen",
                    "Ngaliyan",
                    "Tugu"
                ],
                datasets: [{
                    label: ["Jumlah menara"],
                    backgroundColor: [
                        '#9b5de5',
                        '#f15bb5',
                        '#fee440',
                        '#00bbf9',
                        '#00f5d4',
                        '#9b5de5',
                        '#f15bb5',
                        '#fee440',
                        '#00bbf9',
                        '#00f5d4',
                        '#9b5de5',
                        '#f15bb5',
                        '#fee440',
                        '#00bbf9',
                        '#00f5d4',
                        '#9b5de5',
                    ],
                    borderColor: [
                        '#9b5de5',
                        '#f15bb5',
                        '#fee440',
                        '#00bbf9',
                        '#00f5d4',
                        '#9b5de5',
                        '#f15bb5',
                        '#fee440',
                        '#00bbf9',
                        '#00f5d4',
                        '#9b5de5',
                        '#f15bb5',
                        '#fee440',
                        '#00bbf9',
                        '#00f5d4',
                        '#9b5de5',
                    ],
                    data: data,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
            }
        });
    </script>
@endsection

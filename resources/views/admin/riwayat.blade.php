@extends('layouts.main-admin')
@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header d-flex justify-content-between">
                    <h1><b>Riwayat</b></h1>
                    {{-- Search bar --}}
                    <div class="form-group">
                        {{-- <div class="input-group" >
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            </div>
                                <input type="text" class="form-control" id="pillInput" placeholder="Cari...">
                        </div> --}}
                        <form action="/admin/riwayat">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="search" placeholder="Cari Nomor Tiket" value="{{ request('search') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($data as $d)
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <div class="row d-flex align-items-center">
                                            <div class="ml-3"><b>{{ $d->tower->idMenara }}</b></div>
                                            <div class="ml-3">{{ $d->updated_at->format('d F Y') }}</div>
                                            {{-- <div class="hr"></div> --}}
                                            {{-- <hr> --}}
                                            <div class="ml-2 pl-2" style="border-left: 1px solid #575962;">{{ $d->id }}</div>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                            <h2 class="mr-3">
                                                @if ($d->status->id === 2)
                                                    <span class="badge badge-success">{{ $d->status->name }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $d->status->name }}</span>
                                                @endif
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h1>{{ $d->tower->pemilik }}</h1>
                                    <div class="mb-2 d-flex row justify-content-between">
                                        <div class="col-lg-6">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span class="ml-1">{{ $d->tower->kelurahan->name }},
                                                {{ $d->tower->kecamatan->name }}</span>
                                            {{-- <span>{{ $d->tower->kecamatan->name }}</span> --}}
                                        </div>
                                        <a href="#" class="mx-3">
                                            <b><i>Detail</i></b>
                                            <i class="icofont-simple-right "></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id Tower</th>
                                                <th>Operator</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Jenis Menara</th>
                                                <th>Tinggi</th>
                                                <th>Info Lengkap</th>
                                                <th>Lampiran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>SMG454</td>
                                                <td>System Architect</td>
                                                <td>-7.09275</td>
                                                <td>110.32743</td>
                                                <td>Makro</td>
                                                <td>52</td>
                                                <td><a href="#" data-toggle="modal" data-target="#modalRiwayat">Detail <i class="fas fa-chevron-right"></i></a></td>
                                                <td><a href="#">Dokumen <i class="fas fa-chevron-right"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable();
        })
    </script>
    {{-- <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
@endsection

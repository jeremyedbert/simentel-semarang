@extends('layouts.main-admin')
@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header d-flex justify-content-between">
                    <h1 style="color: black" class="pb-3"><b>Riwayat</b></h1>
                    {{-- Search bar --}}
                    <div class="form-group py-0">
                        <form action="/admin/riwayat">
                            <div class="input-group pb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="search" placeholder="Cari Nomor Tiket"
                                    value="{{ request('search') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if ($data->count())
                            @foreach ($data as $d)
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <div class="row d-flex align-items-center">
                                                <div class="ml-3"><b>{{ $d->tower->idMenara }}</b></div>
                                                <div class="ml-3">
                                                    {{ $d->updated_at->translatedFormat('d F Y') }}</div>
                                                <div class="ml-2 pl-2" style="border-left: 1px solid #575962; color: #177dff">
                                                    <b>{{ $d->id }}</b></div>
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
                                        <a href="/admin/riwayat/{{ $d->id }}" style="text-decoration: none; color: inherit"><h1>{{ $d->tower->pemilik }}</h1></a>
                                        <div class="mb-2 d-flex row justify-content-between">
                                            <div class="col-lg-6">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span class="ml-1">{{ $d->tower->kelurahan->name }},
                                                    {{ $d->tower->kecamatan->name }}</span>
                                                {{-- <span>{{ $d->tower->kecamatan->name }}</span> --}}
                                            </div>
                                            <a href="/admin/riwayat/{{ $d->id }}" class="mx-3">
                                                <b><i>Detail</i></b>
                                                <i class="icofont-simple-right "></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{ $d->status->name }} oleh: {{ $d->admin->name }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3 class="text-center">Tidak ada data. <a href="/admin/riwayat">Kembali</a></h3>
                        @endif

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

@extends('layouts.main-admin')
@section('content')
    <style>
        .bld {
            font-weight: bold
        }

    </style>
    {{-- View ini dipakai oleh menara macro dan micro --}}
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h1 style="color: black" class="pb-3"><b>Detail Menara&nbsp;</b></h1>
                    <h1 style="color: #e83e8c" class="pb-3"> <b>{{ $data->idMenara }}</b></h1>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="/admin/menara/{{ $data->tipe_menara_id === 1 ? 'makro' : 'mikro' }} "> <i
                            class="fas fa-chevron-left"></i> Daftar menara</a>
                    {{-- <a href="/admin/peta/{{ $data->tipe_menara_id === 1 ? 'makro' : 'mikro' }} "> <i
                            class="fas fa-map-marked"></i> Peta menara
                        {{ $data->tipe_menara_id === 1 ? 'makro' : 'mikro' }}</a> --}}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{-- Card --}}
                        <div class="card mt-3">
                            <div class="card-body">
                                {{-- <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                                    <p>Alamat</p>
                                    <p>{{ $data['idMenara'] }}</p>
                                </div> --}}
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="bld">Operator</td>
                                            <td>
                                                @if ($data->operator === null)
                                                    -
                                                @else
                                                    {{ $data->operator }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bld">Alamat</td>
                                            <td>Kelurahan {{ $data->kelurahan->name }}, Kecamatan
                                                {{ $data->kecamatan->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bld">Tinggi</td>
                                            <td>{{ $data->tinggi }} meter</td>
                                        </tr>
                                        <tr>
                                            <td class="bld">Luas Area</td>
                                            <td>{{ $data->luas }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bld">Tipe Site</td>
                                            <td>{{ $data->tipesite->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bld">Tipe Jalan</td>
                                            <td>{{ $data->tipejalan->name }}</td>
                                        </tr>

                                        <tr>
                                            <td class="bld">Koordinat</td>
                                            <td>Latitude: {{ $data->latitude }} &nbsp;|&nbsp; Longitude:
                                                {{ $data->longitude }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bld">Kondisi Sekitar</td>
                                            <td>
                                                @if ($data->kondisi === null)
                                                    -
                                                @else
                                                    {{ $data->kondisi }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bld">Pemilik</td>
                                            <td>
                                                @if ($data->pemilik === null)
                                                    -
                                                @else
                                                    {{ $data->pemilik }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bld">Penyewa</td>
                                            <td>
                                                @if ($data->penyewa === null)
                                                    -
                                                @else
                                                    {{ $data->penyewa }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bld">Nomor IMB</td>
                                            <td>
                                                @if ($data->nomorIMB === null)
                                                    -
                                                @else
                                                    {{ $data->nomorIMB }}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
@endsection

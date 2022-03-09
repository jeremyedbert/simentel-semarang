@extends('layouts.main-admin')
@section('content')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}">
        //punya jeremy
    </script>
    <script>
        function initialize() {
            const lat = document.getElementById('txtLat').innerHTML;
            const lng = document.getElementById('txtLng').innerHTML;

            // Vector Icon Marker
            const svgMark = {
                url: "{{ url('/images/tower_marker.svg') }}",
                scaledSize: new google.maps.Size(40, 40), // scaled size
            };

            map = new google.maps.Map(document.getElementById("map_canvas"), {
                zoom: 15,
                center: new google.maps.LatLng(lat, lng),
            });

            const marker = new google.maps.Marker({
                // The below line is equivalent to writing:
                // position: new google.maps.LatLng(-34.397, 150.644)
                icon: svgMark,
                position: new google.maps.LatLng(lat, lng),
                map: map,
                title: "Klik untuk detail",
            });

            // You can use a LatLng literal in place of a google.maps.LatLng object when
            // creating the Marker object. Once the Marker object is instantiated, its
            // position will be available as a google.maps.LatLng object. In this case,
            // we retrieve the marker's position using the
            // google.maps.LatLng.getPosition() method.
            const infowindow = new google.maps.InfoWindow({
                content: "<p>ID Menara: {{ $data->tower->idMenara }}</p>" +
                    '<a href="/admin/menara/makro/{{ $data->tower->id }}">Info Tower </a> ',
            });

            google.maps.event.addListener(marker, "click", () => {
                infowindow.open(map, marker);
            });
        }
    </script>

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h1 style="color: black" class="pb-3"><b>Detail Permohonan&nbsp;</b></h1>
                    {{-- <h1 style="color: #e83e8c" class="pb-3"> <b>#{{ $data->id }}</b></h1> --}}
                </div>
                <a href="/admin/riwayat/"> <i class="fas fa-chevron-left"></i> Kembali ke daftar riwayat</a>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                @if ($data->status->id === 2)
                                    <span class="badge badge-success">{{ $data->status->name }}</span>
                                @else
                                    <span class="badge badge-danger">{{ $data->status->name }}</span>
                                @endif
                                <i class="ml-2">
                                    @if (auth()->user()->id === $data->admin->id)
                                        Anda
                                        @if ($data->status->id === 2)
                                            menyetujui
                                        @else
                                            menolak
                                        @endif permohonan ini pada {{ ltrim($data->updated_at->translatedFormat('d F Y'), '0') }}
                                    @else
                                        Admin {{ $data->admin->name }}
                                        @if ($data->status->id === 2)
                                            menyetujui
                                        @else
                                            menolak
                                        @endif pendaftaran ini pada {{ ltrim($data->updated_at->translatedFormat('d F Y'), '0') }}
                                    @endif
                                </i>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>ID Permohonan</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3" style="color: #177dff">
                                        <b>{{ $data->id }}</b>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>Tanggal Pengajuan</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        {{ ltrim($data->created_at->translatedFormat('d F Y'), '0') }}
                                    </div>
                                </li>
                            </ul>

                            <div class="card-header">
                                <i>
                                    Detail Menara
                                </i>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>ID Menara</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        {{ $data->tower->id }}
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>Pemilik</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        {{ $data->tower->pemilik }}
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>Operator</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        @if ($data->tower->operator === null)
                                            -
                                        @else
                                            {{ $data->tower->operator }}
                                        @endif
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>Penyewa</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        @if ($data->tower->penyewa === null)
                                            -
                                        @else
                                            {{ $data->tower->penyewa }}
                                        @endif
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>Tipe Menara</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        {{ $data->tower->tipemenara->name }}
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>Tipe Site</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        {{ $data->tower->tipesite->name }}
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>Tipe Jalan</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        {{ $data->tower->tipejalan->name }}
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>Ketinggian</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        {{ $data->tower->tinggi }} meter
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>Luas</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        {{ $data->tower->luas }}
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>No IMB</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        @if ($data->tower->nomorIMB === null)
                                            -
                                        @else
                                            {{ $data->tower->nomorIMB }}
                                        @endif
                                    </div>
                                </li>
                            </ul>
                            <div class="card-header">
                                <i>
                                    Lokasi Menara
                                </i>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>Kecamatan, Kelurahan</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        {{ $data->tower->kecamatan->name }}, {{ $data->tower->kelurahan->name }}
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>Latitude, Longitude</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        <div id="txtLat">{{ $data->tower->latitude }}</div>
                                        <div><span>,&nbsp;<span></div>
                                        <span>
                                            <div id="txtLng">
                                                {{ $data->tower->longitude }}
                                            </div>
                                        </span>
                                    </div>
                                </li>
                            </ul>
                            {{-- Map --}}
                            <div class="card-footer">
                                <div id="map_canvas" class="mx-3 my-3" style="width: auto; height: 350px;"></div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>Kondisi</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3">
                                        @if ($data->tower->kondisi === null)
                                            -
                                        @else
                                            {{ $data->tower->kondisi }}
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
@endsection

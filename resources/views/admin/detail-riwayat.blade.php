@extends('layouts.main-admin')
@section('content')
    <script type="text/javascript" {{-- src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvvsS4RB2Kj8LBp0t3yxRtMAhpzZxtKMQ"> //punya jeremy --}}
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8">
        //punya willy
    </script>
    <script>
        function initialize() {
            // Creating map object
            var lat = document.getElementById('txtLat').innerHTML;
            var lng = document.getElementById('txtLng').innerHTML;
            // const uluru = {
            //     lat: -7.095,
            //     lng: 110.095
            // };
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 15,
                // center: new google.maps.LatLng(-7.09275, 110.32743),
                scrollwheel: false,
                center: new google.maps.LatLng(lat, lng),
                // center: uluru,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            // creates a draggable marker to the given coords
            var vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                // position: uluru,
                draggable: false
            });

            // adds a listener to the marker
            // gets the coords when drag event ends
            // then updates the input with the new coords
            google.maps.event.addListener(vMarker, 'dragend', function(evt) {
                $("#txtLat").val(evt.latLng.lat().toFixed(6));
                $("#txtLng").val(evt.latLng.lng().toFixed(6));

                map.panTo(evt.latLng);
            });

            // centers the map on markers coords
            map.setCenter(vMarker.position);

            // adds the marker on the map
            vMarker.setMap(map);
        }
    </script>

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header" style="border-bottom: 1px solid #aaaaaa;">
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
                                        @endif permohonan ini pada
                                        {{ ltrim($data->updated_at->translatedFormat('d F Y'), '0') }}
                                    @else
                                        Admin {{ $data->admin->name }}
                                        @if ($data->status->id === 2)
                                            menyetujui
                                        @else
                                            menolak
                                        @endif pendaftaran ini pada
                                    @endif
                                    {{ ltrim($data->updated_at->translatedFormat('d F Y'), '0') }}
                                </i>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-start align-items-center">
                                    <div class="d-flex col-lg-6 align-items-center ">
                                        <b>ID Permohonan</b>
                                    </div>
                                    <div class="d-flex col-lg-6 align-items-center mx-md-3" style="color: #e83e8c">
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
                                        {{ $data->tower->penyewa }}
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

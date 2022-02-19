@extends('layouts.main-user')
@section('content')

    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvvsS4RB2Kj8LBp0t3yxRtMAhpzZxtKMQ&callback=initialize&v=weekly"
        async>
        //punya jeremy
        // src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8">
        //punya willy
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
            });
            // You can use a LatLng literal in place of a google.maps.LatLng object when
            // creating the Marker object. Once the Marker object is instantiated, its
            // position will be available as a google.maps.LatLng object. In this case,
            // we retrieve the marker's position using the
            // google.maps.LatLng.getPosition() method.
            const infowindow = new google.maps.InfoWindow({
                content: "<p>Marker Location:" + marker.getPosition() + "</p>",
            });

            google.maps.event.addListener(marker, "click", () => {
                infowindow.open(map, marker);
            });
        }

        
    </script>

    <style>
        .user-profile {
            background-color: #223a66;
            color: #fafafa;
        }

        .user-icon {
            font-size: 120pt;
        }

        .nama-user {
            color: #fafafa;
        }

        .detail h6 {
            text-align: end;
            margin-bottom: 0;
            /* font-weight: normal; */
        }

        .striped {
            background-color: #fafafa;
        }

        @media (max-width:768px) {
            .user-profile {
                flex-direction: row;
            }
        }

        #map_canvas {
            height: 300px;
        }

    </style>
    <section class="mt-4">
        <div class="d-flex row d-inline-block mb-5">
            
            <div class="col-lg-8 mx-auto" style=" min-height: 80vh ">
                <div class="col-lg-11 pl-lg-0">
                    <h2 class="title-color mb-2">Menara {{ $data->idMenara }}</h2>
                    <div class="divider mb-4"></div>
                    <h6 class="mb-3">
                        <a href="/user/peta-menara">
                            <i class="icofont-simple-left"></i>
                            <i>Kembali ke halaman Peta</i>
                        </a>
                    </h6>

                    <div class="detail">
                        <div class="col-lg-12 shadow py-4 mb-3" style="border-radius: 7px; border-left: rgba(255, 193, 7, 0.7) solid 7px">
                            {{-- <div class="mx-3 mb-4 pb-2" style="border-bottom: #bac6d1 solid 1px">
                                <div>
                                    <h3>
                                        @if ($data->status->id === 1)
                                            <span class="badge bg-warning text-dark"
                                                style="opacity: 0.7">{{ $data->status->name }}</span>
                                        @elseif ($data->status->id === 2)
                                            <span class="badge bg-success"
                                                style="opacity: 0.7; color: white">{{ $data->status->name }}</span>
                                        @else
                                            <span class="badge bg-danger"
                                                style="opacity: 0.7; color: white">{{ $data->status->name }}</span>
                                        @endif
                                    </h3>
                                    @if ($data->status->id === 1)
                                        <p style="color: black" class="mb-2"><i>Harap tunggu, permohonan izin
                                                menara Anda sedang kami tinjau.</i></p>
                                    @elseif ($data->status->id === 2)
                                        <p style="color: black" class="mb-2"><i>Permohonan izin menara Anda telah
                                                disetujui pada
                                                <b>{{ ltrim($data->updated_at->translatedFormat('d F Y'), '0') }}</b>.</i>
                                        </p>
                                    @else
                                        <p style="color: black" class="mb-2"><i>Maaf, permohonan izin menara Anda
                                                ditolak pada
                                                <b>{{ ltrim($data->updated_at->translatedFormat('d F Y'), '0') }}</b>.</i>
                                        </p>
                                    @endif

                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    ID Permohonan
                                    <h6>{{ $data->id }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Tanggal Pengajuan
                                    <h6>{{ ltrim($data->created_at->translatedFormat('d F Y'), '0') }}</h6>
                                </div>
                            </div> --}}

                            <div class="mx-3 mb-4 pb-2" style="border-bottom: #bac6d1 solid 1px">
                                <div>
                                    <h5>Detail Menara</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    ID Menara
                                    <h6>{{ $data->idMenara }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Pemilik
                                    <h6>{{ $data->pemilik }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    Operator
                                    <h6>
                                        @if ($data->operator === null)
                                            -
                                        @else
                                            {{ $data->operator }}
                                        @endif
                                    </h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Penyewa
                                    <h6>
                                        @if ($data->penyewa === null)
                                            -
                                        @else
                                            {{ $data->penyewa }}
                                        @endif
                                    </h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    Tipe Menara
                                    <h6>{{ $data->tipemenara->name }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Tipe Site
                                    <h6>{{ $data->tipesite->name }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    Tipe Jalan
                                    <h6>{{ $data->tipejalan->name }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Ketinggian
                                    <h6>{{ $data->tinggi }} meter</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    Luas
                                    <h6>{{ $data->luas }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Nomor IMB
                                    <h6>
                                        @if ($data->nomorIMB === null)
                                            -
                                        @else
                                            {{ $data->nomorIMB }}
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            <div class="mx-3 mb-4 pb-2">
                                <div>
                                    <h5>Lokasi Menara</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    Kecamatan
                                    <h6>{{ $data->kecamatan->name }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Kelurahan
                                    <h6>{{ $data->kelurahan->name }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    Latitude
                                    <h6 id="txtLat" name="latitude">{{ $data->latitude }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Longitude
                                    <h6 id="txtLng" name="longitude">{{ $data->longitude }}</h6>
                                </div>
                                <div class="mx-md-3 mt-3">
                                    <div id="map_canvas"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

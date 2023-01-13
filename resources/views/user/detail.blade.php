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
            let zones = @json($zones);
            const lat = document.getElementById('txtLat').innerHTML;
            const lng = document.getElementById('txtLng').innerHTML;

            // Vector Icon Marker
            const svgMark = {
                url: "{{ url('/images/tower_marker.png') }}",
                scaledSize: new google.maps.Size(30, 38), // scaled size
            };
            const towerRejected = {
                url: "{{ url('/images/tower_rejected.png') }}",
                scaledSize: new google.maps.Size(30, 34.9), // scaled size
            };
            const towerPending = {
                url: "{{ url('/images/tower_pending.png') }}",
                scaledSize: new google.maps.Size(30, 38), // scaled size
            };

            /* Passing blade variable to javascript */
            let code = @json($data)

            if (code['status_id'] == 2) {
                icon = svgMark;
            } else if (code['status_id'] == 1) {
                icon = towerPending;
            } else {
                icon = towerRejected;
            }

            map = new google.maps.Map(document.getElementById("map_canvas"), {
                zoom: 15,
                center: new google.maps.LatLng(lat, lng),
            });

            const marker = new google.maps.Marker({
                // The below line is equivalent to writing:
                // position: new google.maps.LatLng(-34.397, 150.644)
                icon: icon,
                position: new google.maps.LatLng(lat, lng),
                map: map,
            });
            // You can use a LatLng literal in place of a google.maps.LatLng object when
            // creating the Marker object. Once the Marker object is instantiated, its
            // position will be available as a google.maps.LatLng object. In this case,
            // we retrieve the marker's position using the
            // google.maps.LatLng.getPosition() method.
            let tipe = {{ $tipe }};
            if (tipe == 1){
                url = 'peta-makro';
            } else{
                url = 'peta-mikro';
            }

            if (code['status_id'] == 1 || code['status_id'] == 3) {
                    content = "<p>Koordinat: " + marker.getPosition() + "</p>";
            } else {
                content = `<div class="text-center"><b>
                                <a href="/user/` + url + `/` + code['tower_id'] + `">{{ $data->tower->idMenara }} (Klik di sini)</a></b>
                                    <p>Koordinat: ` +
                                        marker.getPosition() +
                                    `</p></div>`;
            }

            for (zone in zones) {
                zone = zones[zone];
                let buildCircle = {
                    strokeColor: "#fa9e52",
                    strokeOpacity: 0.8,
                    strokeWeight: 1,
                    fillColor: "#fa9e52",
                    fillOpacity: 0.5,
                    map: map,
                    center: new google.maps.LatLng(zone.latitude, zone.longitude),
                    radius: zone.radius,
                    visible: true
                };

                zoneCircle = new google.maps.Circle(buildCircle);
            }
            
            const infowindow = new google.maps.InfoWindow({
                content: content,
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
            height: 400px;
        }

    </style>
    <section class="mt-4">
      <div class="container">
        <div class="d-flex row mb-5">

            <div class="col-lg-4 d-flex" style="height:min-content">
                <div class="col-lg-11 user-profile shadow px-3 py-4 mb-5 bg-body" style="border-radius: 16px">
                    <div class="material-icons-outlined user-icon d-flex justify-content-center mb-3" id="">account_circle
                    </div>
                    {{-- <i class="icofont-business-man-alt-1"></i> --}}
                    <div class="col px-auto">
                        <div class="d-flex justify-content-center">
                            <h3 class="nama-user">
                                {{ auth()->user()->name }}
                            </h3>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="material-icons-outlined mr-2">
                                email
                            </span>
                            <span>
                                {{ auth()->user()->email }}
                            </span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="material-icons-outlined mr-2">
                                phone_iphone
                            </span>
                            {{ auth()->user()->phone }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mx-auto" style=" min-height: 80vh ">
                <div class="col-lg-12 p-0 pr-lg-3">
                    <h2 class="title-color mb-2">Detail Permohonan</h2>
                    <div class="divider mb-4"></div>
                    <h6 class="mb-3">
                        <a href="/user/riwayat">
                            <i class="icofont-simple-left"></i>
                            <i>Kembali ke halaman Riwayat Permohonan</i>
                        </a>
                    </h6>

                    <div class="detail">
                        <div class="col-lg-12 shadow py-4 mb-3"
                            @if ($data->status->id === 1) style="border-radius: 7px; border-left: rgba(255, 193, 7, 0.7) solid 7px"
                        @elseif ($data->status->id === 2) style="border-radius: 7px; border-left: rgba(40, 167, 69,
                            0.7) solid 7px"
                        @else style="border-radius: 7px; border-left: rgba(220, 53, 69, 0.7) solid 7px" @endif>
                            <div class="mx-3 mb-4 pb-2" style="border-bottom: #bac6d1 solid 1px">
                                <div>
                                    <h3 id="getText">
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
                                                <b>{{ $data->updated_at->translatedFormat('d F Y') }}</b>
                                                pukul
                                                <b>{{ $data->updated_at->translatedFormat('h.m') }}</b>
                                            </i>
                                        </p>
                                    @else
                                        <p style="color: black" class="mb-2"><i>Maaf, permohonan izin menara Anda
                                                ditolak pada
                                                <b>{{ $data->updated_at->translatedFormat('d F Y') }}</b>
                                                pukul
                                                <b>{{ $data->updated_at->translatedFormat('h.m') }}</b>
                                            </i>
                                        </p>
                                    @endif

                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    ID Permohonan
                                    <h6>{{ $data->id }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Tanggal Pengajuan
                                    {{-- <h6>{{ ltrim($data->created_at->translatedFormat('d F Y'), '0') }}</h6> --}}
                                    <h6>{{ $data->created_at->translatedFormat('d F Y, h.m') }}</h6>
                                </div>
                            </div>

                            <div class="mx-3 mb-4 pb-2" style="border-bottom: #bac6d1 solid 1px">
                                <div>
                                    <h5>Detail Menara</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    ID Menara
                                    <h6>{{ $data->tower->idMenara }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Pemilik
                                    <h6>{{ $data->tower->pemilik }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    Operator
                                    <h6>
                                        @if ($data->tower->operator === null)
                                            -
                                        @else
                                            {{ $data->tower->operator }}
                                        @endif
                                    </h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Penyewa
                                    <h6>
                                        @if ($data->tower->penyewa === null)
                                            -
                                        @else
                                            {{ $data->tower->penyewa }}
                                        @endif
                                    </h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    Tipe Menara
                                    <h6>{{ $data->tower->tipemenara->name }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Tipe Site
                                    <h6>{{ $data->tower->tipesite->name }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    Tipe Jalan
                                    <h6>{{ $data->tower->tipejalan->name }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Ketinggian
                                    <h6>{{ $data->tower->tinggi }} meter</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    Luas
                                    <h6>{{ $data->tower->luas }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Nomor IMB
                                    <h6>
                                        @if ($data->tower->nomorIMB === null)
                                            -
                                        @else
                                            {{ $data->tower->nomorIMB }}
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            <div class="mx-3 mb-4 pb-2" style="border-bottom: #bac6d1 solid 1px">
                                <div>
                                    <h5>Lokasi Menara</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    Kecamatan
                                    <h6>{{ $data->tower->kecamatan->name }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Kelurahan
                                    <h6>{{ $data->tower->kelurahan->name }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center striped p-1 mx-md-3">
                                    Latitude
                                    <h6 id="txtLat" name="latitude">{{ $data->tower->latitude }}</h6>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-1 mx-md-3">
                                    Longitude
                                    <h6 id="txtLng" name="longitude">{{ $data->tower->longitude }}</h6>
                                </div>
                                <div class="mx-md-3 mt-3 pb-3">
                                    <div id="map_canvas"></div>
                                </div>
                            </div>
                            <div class="mx-3 mb-4 pb-2" style="border-bottom: #bac6d1 solid 1px">
                                <div>
                                    <h5>Lampiran/Dokumen</h5>
                                </div>
                                <div class="d-flex justify-content-center mx-md-3">
                                    <iframe {{-- src="https://drive.google.com/viewerng/viewer?embedded=true&url={{ asset('storage/' . $data->document) }}#toolbar=0&scrollbar=0" --}}
                                        src="{{ asset('storage/documents/' . $data->document) }}" frameBorder="0"
                                        scrolling="auto" height="400px" width="100%"></iframe>
                                </div>
                                <div class="d-flex justify-content-center p-1 mx-md-3">
                                    <a href="{{ asset('storage/documents/' . $data->document) }}" target="blank"><i
                                            class="icofont-ui-file"></i>&nbsp;Lihat Dokumen</a>
                                </div>
                            </div>
                            @if ($data->status->id === 2)
                                <div class="mx-3 mb-4 pb-2" style="border-bottom: #bac6d1 solid 1px">
                                    <div>
                                        <h5>Kondisi</h5>
                                    </div>
                                    <div class="p-1 mx-md-3">
                                        {{ $data->tower->kondisi }}
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if ($data->status->id === 1)
                            <div class="d-flex justify-content-lg-end">
                                {{-- <a href="#" class="col-lg-3 btn btn-solid-border-2 btn-round-full mt-1 mx-1 mx-md-2">
                              Batalkan
                            </a> --}}
                                <button type="button"
                                    class="col-lg-3 btn btn-solid-border-2 btn-round-full mt-1 mx-1 mx-md-2"
                                    data-toggle="modal" data-target="#modalBatalkan">
                                    Batalkan
                                </button>
                                <a href="/user/riwayat/{{ $data->id }}/edit"
                                    class="col-lg-3 btn btn-solid-border btn-round-full mt-1 mx-1 mx-md-2">
                                    Edit
                                </a>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modalBatalkan" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembatalan</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Pembatalan akan menghapus permohonan.
                                            Apakah Anda yakin akan membatalkan permohonan izin menara?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-round-full btn-transparent"
                                                data-dismiss="modal">Kembali</button>
                                            <form action="/user/riwayat/{{ $data->id }}/destroy" method="post">
                                                {{-- @method('delete') --}}
                                                @csrf
                                                <button class="btn btn-round-full btn-solid-border-2">
                                                    Ya, batalkan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            {{-- <div class="modal fade" id="modalBatalkan" data-backdrop="static" 
                          data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" 
                          aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Pembatalan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Pembatalan akan menghapus permohonan. 
                                Apakah Anda yakin akan membatalkan permohonan izin menara? 
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="button" class="btn btn-primary">Ya, batalkan</button>
                              </div>
                            </div>
                          </div>
                        </div> --}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
@endsection

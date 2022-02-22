@extends('layouts.main-user')
@section('content')
    {{-- <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvvsS4RB2Kj8LBp0t3yxRtMAhpzZxtKMQ"> //punya jeremy
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8"> //punya willy
        
    </script> --}}
    {{-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg"
    ></script> --}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script>
        function initialize() {
            // const lat = document.getElementById('txtLat').innerHTML;
            // const lng = document.getElementById('txtLng').innerHTML;
            let towers = @json($towerMakro);
            // Vector Icon Marker
            const svgMark = {
                url: "{{ url('/images/tower_marker.svg') }}",
                scaledSize: new google.maps.Size(40, 40), // scaled size
            };

            let map = new google.maps.Map(document.getElementById("map_canvas"), {
                zoom: 12,
                center: new google.maps.LatLng(-6.977, 110.416664),
            });

            document.getElementById("submit").addEventListener("click", () => {
                searchPos(map);
                // setSam();
            });

            let infowindow = new google.maps.InfoWindow();

            for (tower in towers) {
                tower = towers[tower];
                if (tower.latitude && tower.longitude) {
                    let marker = new google.maps.Marker({
                        position: new google.maps.LatLng(tower.latitude, tower.longitude),
                        icon: svgMark,
                        map: map,
                        title: "Klik untuk detail"
                    });

                    // InfoWindow
                    google.maps.event.addListener(marker, 'click', (function(marker, tower) {
                        return function() {
                            infowindow.setContent(theContent(marker, tower))
                            infowindow.open(map, marker);
                        }
                    })(marker, tower));
                }
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        }

        function theContent(marker, tower) {
            let kelurahan = @json($kelurahan);
            let kecamatan = @json($kecamatan);
            let tipesite = @json($tipesite);
            let i = tower.kelurahan_id; // indeks kelurahan
            let j = tower.kecamatan_id; // indeks kecamatan
            let k = tower.tipe_site_id;

            let content =
                `
          <style>
          .bor{
              border-bottom: 1px solid #aaaaaa
          }
          </style>
          <div class="mx-1">
              <div class="bor text-center"><b>
                  <a href="/user/peta-menara/` + tower.id +
                `" style="text-decoration:none;">` + tower
                .idMenara + `</a></b>
              </div>
              <div class="mt-2">
                  Pemilik: ` + tower.pemilik +
                `</div>
              <div>
                  Koordinat: ` + marker.getPosition() + `
              </div>
              <div>
                  Tinggi: ` + tower.tinggi + ` meter
              </div>
              <div>
                  Posisi: Kelurahan ` + kelurahan[i] + `, Kecamatan ` + kecamatan[j] + `
              </div>
              <div>
                  Tipe Site: ` + tipesite[k] + `
              </div>
          </div>`;
            return content
        }

        // array of markers
        let markers = [];

        function searchPos(map) {
            const lat = document.getElementById("lat").value;
            const lng = document.getElementById("lng").value;
            // const latlngStr = input.split(",", 2);
            const latlng = {
                lat: parseFloat(lat),
                lng: parseFloat(lng),
            };
            map.setZoom(15); // Zoom Map
            const marker = new google.maps.Marker({
                position: latlng,
                map,
                animation: google.maps.Animation.DROP,
                draggable: true
            });

            //draggable
            google.maps.event.addListener(marker, 'drag', function(evt) {
                $("#lat").val(evt.latLng.lat().toFixed(6));
                $("#lng").val(evt.latLng.lng().toFixed(6));
                map.panTo(evt.latlng);
            });

            deleteMarkers();
            markers.push(marker);
            map.setCenter(latlng); // set Center
        }

        function setMapOnAll(map) {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }
        // Removes the markers from the map, but keeps them in the array.
        function hideMarkers() {
            setMapOnAll(null);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            hideMarkers();
            markers = [];
        }

        function keySuccess() {
            if ((document.getElementById('lat').value === "") || (document.getElementById('lng').value === "")) {
                document.getElementById('submit').disabled = true;
            } else {
                document.getElementById('submit').disabled = false;
            }
        }
    </script>
    <style>
        p {
            margin-top: 0;
            margin-bottom: 0;
        }

        .clickable-row:hover {
            color: #e12454;
            background-color: rgba(34, 58, 102, 0.1);
        }

        .dtHorizontalExampleWrapper {
            max-width: 600px;
            margin: 0 auto;
        }

        #dtHorizontalExample th,
        td {
            white-space: nowrap;
        }

    </style>
    <section class="mt-4">
        <div class="container">
            @if (session('resent'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Pesan verifikasi sudah dikirimkan. Silakan lihat kotak masuk Anda.
                </div>
            @endif
            <h2 class="title-color mb-2">Peta Menara Utama</h2>
            <div class="divider mb-4"></div>
            <div class="col">

                <form id="#" method="post" action="#">
                    <div class="row">
                        <div class="col-md-4">
                            <p>Latitude</p>
                            <div class="form-group">
                                <input id="lat" name="latitude" type="text" value="-6.966667" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p>Longitude</p>
                            <div class="form-group">
                                <input id="lng" name="longitude" type="text" value="110.4381" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 align-self-end">
                            <input type="button" id="submit" class="btn btn-main btn-icon btn-round-full mb-3"
                                value="Cari Posisi" />
                        </div>
                    </div>
                </form>

                <form action="/user/peta-menara">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <p>ID Menara</p>
                            <div class="form-group mb-0">
                                <input id="search" name="search" type="text" class="form-control"
                                    value="{{ request('search') }}">
                            </div>
                            <small>Tekan <i>enter</i> untuk mencari</small>
                            {{-- <small style="padding-left">Klik enter untuk melanjutkan</small> --}}
                        </div>
                        {{-- <div class="col-md-2 align-self-end">
                            <input type="button" id="submit" class="btn btn-main btn-icon btn-round-full mb-4"
                                value="Cari ID Menara" />
                            <button type="submit" class="btn btn-main btn-icon btn-round-full mb-4">Cari ID Menara</button>
                        </div> --}}
                    </div>
                </form>

                <div class="form-group">
                    {{-- <div id="map_canvas" style="width: auto; height: 500px;"></div> --}}
                </div>

                {{-- <p style="margin-bottom: 0; color: #e12454"><b>Sebelum submit, silakan cek kembali form yang telah Anda isi</b></p>
                    <p class="mb-4" style="color: #e12454"><b>Apa yang telah Anda isi, tidak dapat diedit.</b></p>
                    <a class="btn btn-main btn-round" href="#">Submit</a> --}}
                <div class="shadow px-3 px-md-4 py-4 my-5" style="border-radius: 7px; border-left: solid #223a66 7px">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-4">
                            <h3 class="title-color mb-0">List Menara Utama</h3>
                            <small class="mb-3"><i>Klik baris untuk melihat detail</i></small>
                        </div>
                        {{-- <div class="col-md-4">
                            <label for="search"><small>Cari ID Menara atau Pemilik</small></label>
                            <input name="search" type="text" class="form-control input-sm" placeholder=""
                                onkeyup="search()">
                        </div> --}}
                    </div>
                    <div class="col-lg-12 px-0 px-md-3 table-responsive">
                        <table class="table table-striped mt-3" id="tabel-menara" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>ID Menara</th>
                                    <th>Pemilik</th>
                                    <th>Lokasi</th>
                                </tr>
                            </thead>
                            @if ($towerMakro->count())
                                <tbody>
                                    @foreach ($towerMakro as $d)
                                        <a href="">
                                            <tr class="clickable-row" data-href="/user/peta-menara/{{ $d->id }}">
                                                <td>{{ $d->idMenara }}</td>
                                                <td>{{ $d->pemilik }}</td>
                                                <td>{{ $d->kelurahan->name }},&nbsp;{{ $d->kecamatan->name }}</td>
                                            </tr>
                                        </a>
                                    @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <td colspan="3" class="text-align-center justify-content-center" style="align-items: center">No Data Found</td>
                                </tbody>
                            @endif

                        </table>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8&callback=initMap&v=weekly&channel=2"
        async></script>
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
    {{-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly&channel=2"
      async
    ></script> --}}
@endsection

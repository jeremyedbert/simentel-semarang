@extends('layouts.main-admin')
@section('content')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}">
    </script>
    <script>
        function initialize() {
            // const lat = document.getElementById('txtLat').innerHTML;
            // const lng = document.getElementById('txtLng').innerHTML;
            let towers = @json($tower);
            // Vector Icon Marker
            const svgMark = {
                url: "{{ url('/images/tower_marker.svg') }}",
                scaledSize: new google.maps.Size(40, 40), // scaled size
            };

            let map = new google.maps.Map(document.getElementById("map_canvas"), {
                zoom: 13,
                center: new google.maps.LatLng(-6.977, 110.416664),
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

            // You can use a LatLng literal in place of a google.maps.LatLng object when
            // creating the Marker object. Once the Marker object is instantiated, its
            // position will be available as a google.maps.LatLng object. In this case,
            // we retrieve the marker's position using the
            // google.maps.LatLng.getPosition() method.
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
                    <a href="/admin/menara/{{ $routes === 'macro' ? 'makro' : 'mikro' }}/` + tower.id +
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
    </script>
    <style>
        .nav-pills>li>.nav-link {
            margin-left: 0px
        }

    </style>

    {{-- View ini dipakai oleh menara macro dan micro --}}
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header" style="border-bottom: 1px solid #aaaaaa;">
                    <h1 style="color: black" class="pb-3"><b>Peta Menara
                            {{ Request::is('admin/peta/makro') ? 'Utama' : 'Mikro' }}</b>
                    </h1>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('decline'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! session()->get('decline') !!}
                    </div>
                @endif
                @if (session()->has('accept'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! session()->get('accept') !!}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-primary mb-3 justify-content-center">
                            <li class="nav-item submenu">
                                <a href="/admin/menara/{{ $routes === 'macro' ? 'makro' : 'mikro' }}"
                                    class="nav-link {{ Request::is('admin/menara*') ? 'active' : '' }}">Tabel</a>
                            </li>
                            <li class="nav-item submenu">
                                <a href="/admin/peta/{{ $routes === 'macro' ? 'makro' : 'mikro' }}"
                                    class="nav-link {{ Request::is('admin/peta*') ? 'active' : '' }}">Peta</a>
                            </li>
                        </ul>
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control" id="latlng" aria-describedby="emailHelp">
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div id="map_canvas" class="mx-3 my-3" style="width: auto; height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
@endsection

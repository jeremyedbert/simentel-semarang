@extends('layouts.main-admin')
@section('content')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}">
    </script>
    {{-- <script>
        let map;

        function initialize() {
            // Initialize json object from tower
            let towers = @json($tower);

            // Vector Icon Marker
            const svgMark = {
                url: "{{ url('/images/tower_marker.svg') }}",
                scaledSize: new google.maps.Size(40, 40), // scaled size
            };

            // Make a new map
            map = new google.maps.Map(document.getElementById("map_canvas"), {
                zoom: 13,
                center: new google.maps.LatLng(-6.977, 110.416664),
            });

            document.getElementById("submit").addEventListener("click", () => {
                searchPos(map);
                // setSam();
            });

            // Initialize InfoWindow
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

            document
                .getElementById("delete")
                .addEventListener("click", deleteMarkers);

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
    </script> --}}
    <script type="text/javascript">
        // array of markers
        let markers = [];
        let zonezones = [];
        // SVG Icon
        const svgMark = {
            url: "{{ url('/images/tower_marker.png') }}",
            scaledSize: new google.maps.Size(22, 28), // scaled size
        };

        const svgAvail = {
            url: "{{ url('/images/tower_avail.svg') }}",
            scaledSize: new google.maps.Size(40, 40), // scaled size
        }

        let pos = new google.maps.LatLng(-6.966667, 110.4381);

        function initialize() {
            // Zona
            let infowindow = new google.maps.InfoWindow();
            let towers = @json($tower);

            // creates a draggable marker to the given coords
            let vMarker = new google.maps.Marker({
                position: pos,
                title: "Drag",
                draggable: true,
            });

            // Creating map object
            let map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 13,
                center: new google.maps.LatLng(-6.966667, 110.4381),
            });

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

            // Add the circle zone for zones to the map.
            // for (zone in zones) {
            //     zone = zones[zone];
            //     let zoneCircle = new google.maps.Circle({
            //         strokeColor: "#8AE2E5",
            //         strokeOpacity: 0.8,
            //         strokeWeight: 1,
            //         fillColor: "#8AE2E5",
            //         fillOpacity: 0.5,
            //         map,
            //         // center: new google.maps.LatLng(zone.latitude, zone.longitude),
            //         center: new google.maps.LatLng(zone.latitude, zone.longitude),
            //         // radius: Math.sqrt(zone.radius) * 10,
            //         radius: zone.radius,
            //     });

            //     zonezones.push(zoneCircle);
            //     // let bound = zoneCircle.getBounds();
            //     // Infowindow Circle

            //     // let noteA = jQuery('.bool#a');
            //     // google.maps.event.addListener(vMarker, 'dragend', function() {
            //     //     let state = false;
            //     //     pos = new google.maps.LatLng(vMarker.position.lat(), vMarker.position.lng());
            //     //     for (let i = 0; i < zonezones.length; i++) {
            //     //         let bound = zonezones[i].getBounds();
            //     //         if (bound.contains(pos)) {
            //     //             state = "Menara dapat dibangun di zona ini.";
            //     //             document.getElementById("rectangle").style.backgroundColor = "green";
            //     //             break;
            //     //         } else {
            //     //             state = "Menara tidak dapat dibangun di zona ini. Admin mungkin akan menolak.";
            //     //             document.getElementById("rectangle").style.backgroundColor = "#e12454";
            //     //         }
            //     //     }
            //     //     noteA.text(state);
            //     // });

            //     google.maps.event.addListener(zoneCircle, 'click', (function(zone) {
            //         return function() {
            //             infowindow.setPosition(new google.maps.LatLng(zone.latitude, zone.longitude));
            //             infowindow.setContent(infoRadius(zone));
            //             infowindow.open(map);
            //         }
            //     })(zone));
            // }

            // ON KEY CHANGE
            document.getElementById("lat").addEventListener("change", () => {
                // searchPos(map);
                const lat = document.getElementById("lat").value;
                const lng = document.getElementById("lng").value;

                pos = {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng),
                };

                // pos = new google.maps.LatLng(lat, lng);
                map.setZoom(15); // Zoom Map
                vMarker.setPosition(pos);
                map.setCenter(vMarker.position); // set Center

                // let noteA = jQuery('.bool#a');
                // let state = false;
                // pos = new google.maps.LatLng(vMarker.position.lat(), vMarker.position.lng());
                // for (let i = 0; i < zonezones.length; i++) {
                //     let bound = zonezones[i].getBounds();
                //         if (bound.contains(pos)) {
                //             state = "Menara dapat dibangun di zona ini.";
                //             document.getElementById("rectangle").style.backgroundColor = "green";
                //             break;
                //         } else {
                //             state = "Menara tidak dapat dibangun di zona ini. Admin mungkin akan menolak.";
                //             document.getElementById("rectangle").style.backgroundColor = "#e12454d";
                //         }
                // }
                // noteA.text(state);
            });

            document.getElementById("lng").addEventListener("change", () => {
                // searchPos(map);
                const lat = document.getElementById("lat").value;
                const lng = document.getElementById("lng").value;

                pos = {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng),
                };

                // pos = new google.maps.LatLng(lat, lng);
                map.setZoom(15); // Zoom Map
                vMarker.setPosition(pos);
                map.setCenter(vMarker.position); // set Center

                // let noteA = jQuery('.bool#a');
                // let state = false;
                // pos = new google.maps.LatLng(vMarker.position.lat(), vMarker.position.lng());
                // for (let i = 0; i < zonezones.length; i++) {
                //     let bound = zonezones[i].getBounds();
                //         if (bound.contains(pos)) {
                //             state = "Menara dapat dibangun di zona ini.";
                //             document.getElementById("rectangle").style.backgroundColor = "green";
                //             break;
                //         } else {
                //             state = "Menara tidak dapat dibangun di zona ini. Admin mungkin akan menolak.";
                //             document.getElementById("rectangle").style.backgroundColor = "red";
                //         }
                // }
                // noteA.text(state);
            });

            // adds a listener to the marker
            // gets the coords when drag event ends
            // then updates the input with the new coords
            google.maps.event.addListener(vMarker, 'dragend', function(evt) {
                $("#lat").val(evt.latLng.lat().toFixed(6));
                $("#lng").val(evt.latLng.lng().toFixed(6));
                map.panTo(evt.latLng);
            });

            // centers the map on markers coords
            map.setCenter(vMarker.position);
            markers.push(vMarker);

            // adds the marker on the map
            vMarker.setMap(map);
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

        function searchPos(map) {
            const lat = document.getElementById("lat").value;
            const lng = document.getElementById("lng").value;
            pos = {
                lat: parseFloat(lat),
                lng: parseFloat(lng),
            };

            // pos = new google.maps.LatLng(lat, lng);
            map.setZoom(15); // Zoom Map
            const vMarker = new google.maps.Marker({
                position: pos,
                map,
                animation: google.maps.Animation.DROP,
                icon: svgAvail,
                title: "Drag",
                draggable: true
            });

            // google.maps.event.addListener(vMarker, 'dragend', function() {
            //     pos = new google.maps.LatLng(vMarker.position.lat(), vMarker.position.lng());
            //     noteA.text(bounds.contains(pos));
            // });

            //draggable
            google.maps.event.addListener(vMarker, 'dragend', function(evt) {
                $("#lat").val(evt.latLng.lat().toFixed(6));
                $("#lng").val(evt.latLng.lng().toFixed(6));
                // pos = new google.maps.LatLng(marker.position.lat(), marker.position.lng())
                map.panTo(evt.latLng);
            });

            deleteMarkers();
            markers.push(vMarker);
            map.setCenter(vMarker.pos); // set Center
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
                <div class="page-header">
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

                        {{-- <div class="row mb-3">
                            <div class="col-lg-6 ml-4">
                                <button class="btn btn-primary btn-xs mt-3" disabled id="submit" type="button">Cari
                                    Posisi</button>
                                <button class="btn btn-danger btn-xs mt-3" id="delete" type="button">Reset Marker</button>
                            </div>
                            <button class="btn btn-primary btn-xs" id="show" type="button">Show Marker</button>
                            <button class="btn btn-primary btn-xs" id="hide" type="button">Hide Marker</button>
                        </div> --}}

                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row d-flex justify-content-between">
                                    <div class="d-flex col-lg-6">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="latitude">Latitude</label>
                                                <input id="lat" type="text" class="form-control" value=""
                                                    autocomplete="off" placeholder="contoh: -6.9356">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="longitude">Longitude</label>
                                                <input id="lng" type="text" class="form-control" value=""
                                                    autocomplete="off" placeholder="contoh: 110.5387">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-end justify-content-end">
                                        <form action="/admin/peta/{{ $routes === 'macro' ? 'makro' : 'mikro' }}">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-search"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="search"
                                                        placeholder="Cari ID Menara" value="{{ request('search') }}">
                                                </div>
                                            </div>
                                            {{-- <small style="padding-left">Klik enter untuk melanjutkan</small> --}}
                                        </form>
                                    </div>
                                </div>
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

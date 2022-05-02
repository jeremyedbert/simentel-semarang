@extends('layouts.main-admin')
@section('content')
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=geometry">
        //punya jeremy
    </script>
    <script type="text/javascript">
        // array of markers
        let markers = [];
        let zonezones = [];
        // SVG Icon
        const svgMark = {
            url: "http://maps.google.com/mapfiles/ms/micons/yellow-dot.png",
            scaledSize: new google.maps.Size(40, 40), // scaled size
        };

        function initialize() {
            let txtLat = document.getElementById('lat').value;
            let txtLng = document.getElementById('lng').value;
            let pos = new google.maps.LatLng(-6.966667, 110.4381);
            let radius = parseInt(document.getElementById('radius').value);
            // Zona

            // creates a draggable marker to the given coords
            let vMarker = new google.maps.Marker({
                position: pos,
                icon: svgMark,
                title: "Drag",
                draggable: true,
            });

            // Creating map object
            let map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 14,
                // center: new google.maps.LatLng(-6.966667, 110.4381),
            });

            let zone = new google.maps.Circle({
                strokeColor: "#FF0000",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#FF0000",
                fillOpacity: 0.35,
                map,
                radius: radius
            });

            zone.bindTo('center', vMarker, 'position');

            google.maps.event.addListener(vMarker, 'dragend', function(evt) {
                $("#lat").val(evt.latLng.lat().toFixed(6));
                $("#lng").val(evt.latLng.lng().toFixed(6));
                map.panTo(evt.latLng);
            });

            document.getElementById("lat").addEventListener("change", () => {
                const newLat = document.getElementById("lat").value;
                const newLng = document.getElementById("lng").value;

                pos = {
                    lat: parseFloat(newLat),
                    lng: parseFloat(newLng),
                };
                vMarker.setPosition(pos);
                map.setCenter(vMarker.position); // set Center
            });

            document.getElementById("lng").addEventListener("change", () => {
                const newLat = document.getElementById("lat").value;
                const newLng = document.getElementById("lng").value;

                // map.setZoom(14); // Zoom Map
                pos = {
                    lat: parseFloat(newLat),
                    lng: parseFloat(newLng),
                };
                vMarker.setPosition(pos);
                map.setCenter(vMarker.position); // set Center
            });

            document.getElementById("radius").addEventListener("change", () => {
                const rad = parseInt(document.getElementById("radius").value);

                zone.setRadius(rad);
                // map.setCenter(vMarker.position);
            });

            // centers the map on markers coords
            map.setCenter(vMarker.position);
            
            // adds the marker on the map
            vMarker.setMap(map);
        }

        function addZone(lat, lng, rad, map) {
            const pos = new google.maps.LatLng(lat, lng);
            // const radius = parseInt(rad);

            let newMarker = new google.maps.Marker({
                position: pos,
                icon: svgMark,
                title: "Drag",
                draggable: true,
            });

            let newZone = new google.maps.Circle({
                strokeColor: "#3385FF",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#3385FF",
                fillOpacity: 0.35,
                map,
                // center: pos,
                radius: rad
            });

            google.maps.event.addListener(newMarker, 'dragend', function(evt) {

                $("#lat").val(evt.latLng.lat().toFixed(6));
                $("#lng").val(evt.latLng.lng().toFixed(6));
                map.panTo(evt.latLng);

                let newLat = document.getElementById('lat').value;
                let newLng = document.getElementById('lng').value;

                deleteMarkers();
                addZone(newLat, newLng, rad, map);

            });

            newZone.bindTo('center', newMarker, 'position');
            zonezones.push(newZone);
            markers.push(newMarker);
            newMarker.setMap(map);
            map.setCenter(newMarker.position);
        }

        function setMapOnAll(map) {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
            for (let i = 0; i < zonezones.length; i++) {
                zonezones[i].setMap(map);
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
            zonezones = []
        }
    </script>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Tambah Zona</h4>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div id="map_canvas" style="width: auto; height: 30rem"></div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="row d-flex justify-content-between">
                                    {{-- <div class="col-md-6">
                            <div class="card-title"><b><i>No. Tiket: {{ $data->id }}</i></b></div>
                            <div class="card-title"><i>{{ $data->tower->idMenara }}</i></div>
                        </div>
                        <div class="d-flex">
                            <div class="col text-md-right">
                                <p class="mb-0 mt-3 mt-md-0"><b>Anda dapat menghubungi pendaftar:</b></p>
                                <p class="mb-0">{{ $data->user->name }}</p>
                                <p class="mb-0">{{ $data->user->phone }}</p>
                                <p class="mb-0">{{ $data->user->email }}</p>
                            </div>
                        </div> --}}
                                </div>
                            </div>
                            {{-- Form Add --}}
                            <form action="/admin/zona" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default"
                                                @error('name') style="border: 1px solid rgb(255, 0, 0)" @enderror>
                                                <label for="name">Nama <span class="required-label">*</span></label>
                                                <input type="text" class="form-control" value="{{ old('name') }}"
                                                    id="name" name="name">
                                                <span class="text-danger">
                                                    @error('name')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tinggi">Tinggi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            value="{{ $data->tower->tinggi }}" id="tinggi" name="tinggi"
                                            readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">meter</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="luas">Luas</label>
                                    <input type="text" class="form-control"
                                        value="{{ $data->tower->luas }}" id="luas" name="luas" readonly>
                                </div>
                            </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default"
                                                @error('radius') style="border: 1px solid rgb(255, 0, 0)" @enderror>
                                                <label for="radius">Radius <span class="required-label">*</span></label>
                                                <input type="text" class="form-control" value="{{ old('radius') }}"
                                                    id="radius" name="radius">
                                                <span class="text-danger">
                                                    @error('radius')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group form-group-default"
                                                @error('kecamatan_id') style="border: 1px solid rgb(255, 0, 0)" @enderror>
                                                <label for="longitude">Kecamatan <span
                                                        class="required-label">*</span></label>
                                                <select class="form-control" name="kecamatan_id" id="kecamatan_id">
                                                    <option value=""> -- Pilih kecamatan -- </option>
                                                    @foreach ($kecamatan as $key => $kec)
                                                        <option value="{{ $key }}"
                                                            {{ old('kecamatan_id') == $key ? 'selected' : '' }}>
                                                            {{ $kec }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('kecamatan_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default"
                                                @error('latitude') style="border: 1px solid rgb(255, 0, 0)" @enderror>
                                                <label for="latitude">Latitude <span class="required-label">*</span></label>
                                                <input type="text" class="form-control" value="{{ old('latitude', -6.966667) }}"
                                                    id="lat" name="latitude">
                                                <span class="text-danger">
                                                    @error('latitude')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default"
                                                @error('longitude') style="border: 1px solid rgb(255, 0, 0)" @enderror>
                                                <label for="longitude">Longitude <span
                                                        class="required-label">*</span></label>
                                                <input type="text" class="form-control" value="{{ old('longitude', 110.4381) }}"
                                                    id="lng" name="longitude">
                                                <span class="text-danger">
                                                    @error('longitude')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            Berikan <i><b>radius</b></i> supaya zona dapat terlihat pada peta
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button class="btn btn-success" type="submit">
                                        <span class="btn-label">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        Simpan</button>
                                    {{-- <button class="btn btn-danger">Cancel</button> --}}
                                    <a class="btn btn-danger" href="/admin/zona">
                                        <span class="btn-label">
                                            <i class="fas fa-times"></i>
                                        </span>
                                        Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

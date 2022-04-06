<script type="text/javascript">
  // array of markers
  let markers = [];
  let zonezones = [];
  // SVG Icon
  const svgMark = {
      url: "{{ url('/images/tower_marker.svg') }}",
      scaledSize: new google.maps.Size(40, 40), // scaled size
  };

  // let data = @json($pendaftaran);
  // let txtLat = ;
  // let txtLng = ;
  // let lat = parseFloat(txtLat);
  // let lng = parseFloat(txtLng);


  // let pos = {
  //     lat: txtLat,
  //     lng: txtLng
  // };

  function infoRadius(zone) {
      // let content = '<p>' + zone.name + '</p>';
      let kecamatan = @json($kecamatan);
      let i = zone.kecamatan_id; // indeks kecamatan
      let content =
          `
  <style>
  .bor{
      border-bottom: 1px solid #aaaaaa
  }
  </style>
  <div class="mx-1">
      <div class="bor text-center"><b>` + zone.name + `</b>
      </div>
      <div class="mt-2">
          Kecamatan: ` + kecamatan[i] +
          `</div>
      <div>
          Latitude: ` + zone.latitude + `
      </div>
      <div>
          Longitude: ` + zone.longitude + `
      </div>
  </div>`;

      return content
  }

  function initialize() {
      let txtLat = document.getElementById('lat').value;
      let txtLng = document.getElementById('lng').value;
      let pos = new google.maps.LatLng(txtLat, txtLng);
      // Zona
      let infowindow = new google.maps.InfoWindow();
      let zones = @json($zones);

      // creates a draggable marker to the given coords
      let vMarker = new google.maps.Marker({
          position: pos,
          icon: svgMark,
          title: "Drag",
          draggable: true,
      });

      // Creating map object
      let map = new google.maps.Map(document.getElementById('map_canvas'), {
          zoom: 16,
          center: new google.maps.LatLng(-6.966667, 110.4381),
      });

      // Add the circle zone for zones to the map.
      for (zone in zones) {
          zone = zones[zone];
          let zoneCircle = new google.maps.Circle({
              strokeColor: "#8AE2E5",
              strokeOpacity: 0.8,
              strokeWeight: 1,
              fillColor: "#8AE2E5",
              fillOpacity: 0.5,
              map,
              // center: new google.maps.LatLng(zone.latitude, zone.longitude),
              center: new google.maps.LatLng(zone.latitude, zone.longitude),
              // radius: Math.sqrt(zone.radius) * 10,
              radius: zone.radius,
          });

          zonezones.push(zoneCircle);
          // let bound = zoneCircle.getBounds();
          // Infowindow Circle

          let noteA = jQuery('.bool#a');
          google.maps.event.addListener(vMarker, 'dragend', function() {
              let state = false;
              pos = new google.maps.LatLng(vMarker.position.lat(), vMarker.position.lng());
              for (let i = 0; i < zonezones.length; i++) {
                  let bound = zonezones[i].getBounds();
                  if (bound.contains(pos)) {
                      state = "Menara dapat dibangun di zona ini.";
                      document.getElementById("rectangle").style.backgroundColor = "green";
                      // vMarker.setIcon(svgAvail);
                      break;
                  } else {
                      state = "Menara tidak dapat dibangun di zona ini.";
                      document.getElementById("rectangle").style.backgroundColor = "#e12454";
                      // vMarker.setIcon(svgRejected);
                  }
              }
              noteA.text(state);
          });

          google.maps.event.addListener(vMarker, 'click', function() {
              let state = false;
              pos = new google.maps.LatLng(vMarker.position.lat(), vMarker.position.lng());
              for (let i = 0; i < zonezones.length; i++) {
                  let bound = zonezones[i].getBounds();
                  if (bound.contains(pos)) {
                      state = "Menara dapat dibangun di zona ini.";
                      document.getElementById("rectangle").style.backgroundColor = "green";
                      // vMarker.setIcon(svgAvail);
                      break;
                  } else {
                      state = "Menara tidak dapat dibangun di zona ini. Admin mungkin akan menolak.";
                      document.getElementById("rectangle").style.backgroundColor = "#e12454";
                      // vMarker.setIcon(svgRejected);
                  }
              }
              noteA.text(state);
          });

          google.maps.event.addListener(zoneCircle, 'click', (function(zone) {
              return function() {
                  infowindow.setPosition(new google.maps.LatLng(zone.latitude, zone.longitude));
                  infowindow.setContent(infoRadius(zone));
                  infowindow.open(map);
              }
          })(zone));
      }

      // ON KEY CHANGE
      document.getElementById("lat").addEventListener("change", () => {
          // searchPos(map);
          let lat = document.getElementById("lat").value;
          let lng = document.getElementById("lng").value;

          pos = {
              lat: parseFloat(lat),
              lng: parseFloat(lng),
          };

          // pos = new google.maps.LatLng(lat, lng);
          map.setZoom(15); // Zoom Map

          let noteA = jQuery('.bool#a');
          vMarker.setPosition(pos);
          map.setCenter(vMarker.position); // set Center
          let state = false;
          pos = new google.maps.LatLng(vMarker.position.lat(), vMarker.position.lng());
          for (let i = 0; i < zonezones.length; i++) {
              let bound = zonezones[i].getBounds();
              if (bound.contains(pos)) {
                  state = "Menara dapat dibangun di zona ini.";
                  document.getElementById("rectangle").style.backgroundColor = "green";
                  // vMarker.setIcon(svgAvail);
                  break;
              } else {
                  state = "Menara tidak dapat dibangun di zona ini. Admin mungkin akan menolak.";
                  document.getElementById("rectangle").style.backgroundColor = "#e12454";
                  // vMarker.setIcon(svgRejected);
              }
          }
          noteA.text(state);
      });

      document.getElementById("lng").addEventListener("change", () => {
          // searchPos(map);
          let lat = document.getElementById("lat").value;
          let lng = document.getElementById("lng").value;

          pos = {
              lat: parseFloat(lat),
              lng: parseFloat(lng),
          };

          // pos = new google.maps.LatLng(lat, lng);
          map.setZoom(15); // Zoom Map

          let noteA = jQuery('.bool#a');
          vMarker.setPosition(pos);
          map.setCenter(vMarker.position); // set Center
          let state = false;
          pos = new google.maps.LatLng(vMarker.position.lat(), vMarker.position.lng());
          for (let i = 0; i < zonezones.length; i++) {
              let bound = zonezones[i].getBounds();
              if (bound.contains(pos)) {
                  state = "Menara dapat dibangun di zona ini.";
                  document.getElementById("rectangle").style.backgroundColor = "green";
                  // vMarker.setIcon(svgAvail);
                  break;
              } else {
                  state = "Menara tidak dapat dibangun di zona ini. Admin mungkin akan menolak.";
                  document.getElementById("rectangle").style.backgroundColor = "#e12454";
                  // vMarker.setIcon(svgRejected);
              }
          }
          noteA.text(state);
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
          icon: svgMark,
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
@extends('layouts.main-admin')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Edit Zona</h4>
                </div>
                <div class="row">
                    <div class="col-md-4">
                      
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
                            {{-- Form Edit --}}
                            <form action="/admin/pendaftaran/{{ $data->id }}" method="post">
                                @method('put')
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="pemilik">Nama</label>
                                                <input type="text" class="form-control" value="{{ $data->name }}"
                                                    id="name" name="name">
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
                                            <div class="form-group">
                                                <label for="latitude">Latitude</label>
                                                <input type="text" class="form-control" value="{{ $data->latitude }}"
                                                    id="latitude" name="latitude">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="longitude">Longitude</label>
                                                <input type="text" class="form-control" value="{{ $data->longitude }}"
                                                    id="longitude" name="longitude">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Alamat --}}
                                    {{-- <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="kecamatan">Kecamatan</label>
                                          <input type="text" class="form-control"
                                              value="{{ $data->tower->kecamatan->name }}" id="kecamatan"
                                              name="kecamatan" readonly>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="kelurahan">Kelurahan</label>
                                          <input type="text" class="form-control"
                                              value="{{ $data->tower->kelurahan->name }}" id="kelurahan"
                                              name="kelurahan" readonly>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="latitude">Latitude</label>
                                          <input type="text"
                                              class="form-control @error('latitude') is-invalid @enderror"
                                              value={{ $data->tower->latitude }} id="lat" name="latitude">
                                          @error('latitude')
                                              <div style="color: #dc3545">{{ $message }}</div>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="longitude">Longitude</label>
                                          <input type="text"
                                              class="form-control @error('longitude') is-invalid @enderror"
                                              value={{ $data->tower->longitude }} id="lng" name="longitude">
                                          @error('longitude')
                                              <div style="color: #dc3545">{{ $message }}</div>
                                          @enderror
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group pb-0">
                                  <div id="map_canvas" style="width: auto; height: 500px;"></div>
                              </div> --}}
                                    {{-- <div class="form-group pt-0">
                                  <div>
                                      <div id="rectangle" class="rectangle px-3 py-1">
                                          <div id="a" class="bool" style="color: #fff;"></div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="tipesite">Tipe Site</label>
                                          <input type="text" class="form-control"
                                              value="{{ $data->tower->tipesite->name }}" id="tipesite"
                                              name="tipesite" readonly>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="tipejalan">Tipe Jalan</label>
                                          <input type="text" class="form-control"
                                              value="{{ $data->tower->tipejalan->name }}" id="tipejalan"
                                              name="tipejalan" readonly>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="kondisi">Kondisi</label>
                                  <textarea class="form-control" id="kondisi" name="kondisi"
                                      rows="4">{{ old('kondisi', $data->tower->kondisi) }}</textarea>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="penyewa">Penyewa</label>
                                          <input type="text" class="form-control"
                                              value="{{ old('penyewa', $data->tower->penyewa) }}" id="penyewa"
                                              name="penyewa">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="operator">Operator</label>
                                          <input type="text" class="form-control"
                                              value="{{ old('operator', $data->tower->operator) }}" id="operator"
                                              name="operator">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="noimb">No IMB</label>
                                          <input type="text" class="form-control"
                                              value="{{ old('nomorIMB', $data->tower->noIMB) }}" id="nomorIMB"
                                              name="nomorIMB">
                                      </div>
                                  </div>
                              </div> --}}
                                </div>
                                <div class="card-action">
                                    <button class="btn btn-success" type="submit">Simpan</button>
                                    {{-- <button class="btn btn-danger">Cancel</button> --}}
                                    <a class="btn btn-danger" href="/admin/zona">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

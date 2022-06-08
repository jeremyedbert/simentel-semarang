@extends('layouts.main-user')
@section('content')
    {{-- <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvvsS4RB2Kj8LBp0t3yxRtMAhpzZxtKMQ"> //punya jeremy
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8"> //punya willy
        
    </script> --}}
    {{-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg"
    ></script> --}}
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=geometry"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default">
    </script>
    <script type="text/javascript">
        let pos = new google.maps.LatLng(-6.966667, 110.4381);

        function initialize() {
            let towers = @json($towerMakro);
            let zones = @json($zones);
            // let zones = {
            //   semarang: {
            //     center: { lat: -6.966667, lng: 110.4381 },
            //     rad: 1000,
            //   },
            // };

            // Vector Icon Marker
            const svgMark = {
                url: "{{ url('/images/tower_marker.png') }}",
                scaledSize: new google.maps.Size(22, 28), // scaled size
            };

            let map = new google.maps.Map(document.getElementById("map_canvas"), {
                zoom: 12,
                minZoom: 12,
                // maxZoom: 16,
                // center: new google.maps.LatLng(-6.966667, 110.4381),
                center: pos,
            });
            let vMarker = new google.maps.Marker({
                position: pos,
                title: "Drag",
                draggable: true,
                map: map,
            });

            document.getElementById("cariPosisi").addEventListener("click", () => {
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
            });

            google.maps.event.addListener(vMarker, 'dragend', function(evt) {
                $("#lat").val(evt.latLng.lat().toFixed(6));
                $("#lng").val(evt.latLng.lng().toFixed(6));
                map.panTo(evt.latLng);
                // map.setCenter(vMarker.position);
            });

            // document.getElementById("lat").addEventListener("change", () => {
            //     searchPos(map);
            //     // setSam();
            // });

            // document.getElementById("lng").addEventListener("change", () => {
            //     searchPos(map);
            //     // setSam();
            // });

            let infowindow = new google.maps.InfoWindow();

            //google.map.showZones();
            // Add the circle zone for zones to the map.
            

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
                showHideZone(map, zoneCircle);

                //show zone infowindow
                google.maps.event.addListener(zoneCircle, 'click', (function(zone) {
                    return function() {
                        infowindow.setPosition(new google.maps.LatLng(zone.latitude, zone.longitude));
                        infowindow.setContent(infoRadius(zone));
                        infowindow.open(map);
                    }
                })(zone));
            }

            for (tower in towers) {
                tower = towers[tower];
                if (tower.latitude && tower.longitude) {
                    let buildMarker = {
                        position: new google.maps.LatLng(tower.latitude, tower.longitude),
                        icon: svgMark,
                        map: map,
                        title: "Klik untuk detail",
                        // visible: true
                    };

                    towerMarker = new google.maps.Marker(buildMarker);
                    showHideTower(map, towerMarker)

                    //show tower Infowindow
                    google.maps.event.addListener(towerMarker, 'click', (function(marker, tower) {
                        return function() {
                            infowindow.setContent(theContent(marker, tower))
                            infowindow.open(map, marker);
                        }
                    })(towerMarker, tower));
                }
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        }

        function showHideZone(map, zone){

          document.getElementById("checkboxZone").addEventListener("change", function(){
            if(this.checked){
              zone.setOptions({
                visible: true
              });
            }else{
              zone.setOptions({
                visible: false
              });
            }
          });
          
        }

        function showHideTower(map, tower){

          document.getElementById("checkboxTower").addEventListener("change", function(){
            if(this.checked){
              tower.setOptions({
                visible: true
              });
            }else{
              tower.setOptions({
                visible: false
              });
            }
          });

        }

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
                  <a href="/user/peta-makro/` + tower.id +
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
            pos = {
                lat: parseFloat(lat),
                lng: parseFloat(lng),
            };
            map.setZoom(15); // Zoom Map
            const marker = new google.maps.Marker({
                position: pos,
                map,
                animation: google.maps.Animation.DROP,
                draggable: true
            });

            //draggable
            google.maps.event.addListener(marker, 'dragend', function(evt) {
                $("#lat").val(evt.latLng.lat().toFixed(6));
                $("#lng").val(evt.latLng.lng().toFixed(6));
                map.panTo(evt.pos);
            });

            deleteMarkers();
            markers.push(marker);
            map.setCenter(marker.pos); // set Center
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
                document.getElementById('cariPosisi').disabled = true;
            } else {
                document.getElementById('cariPosisi').disabled = false;
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
            cursor: pointer;
        }

        #linkTable:hover, #linkChart:hover{
          cursor: pointer;
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
            {{-- @if (session('resent'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Pesan verifikasi sudah dikirimkan. Silakan lihat kotak masuk Anda.
                </div>
            @endif --}}
            <h2 class="title-color mb-2">Peta Menara Makro</h2>
            <div class="divider mb-4"></div>
            <div class="col">
              <div class="shadow px-3 px-md-4 pt-4 my-4" id="" 
                style="border-radius: 7px; border-left: solid #223a66 7px">
                <form >
                  <div class="row form-group align-items-center">
                    <div class="pl-3 pr-2">Cari Berdasarkan:</div>
                    <div class="ml-3 ml-md-0">
                      <select class="form-control" name="pilihFilter" id="pilihFilter" onchange="filterPencarian()">
                          <option value=""> -- Pilih -- </option>
                          <option value="koordinat">Koordinat</option>
                          <option value="idmenara" {{ request('search') ? 'selected' : '' }}>ID Menara</option>
                          <option value="keckel" {{ request('kecamatan_id') ? 'selected' : '' }}>Kecamatan & Kelurahan</option>
                      </select>
                    </div>
                  </div>
                </form>
                <p id="demo"></p>

                <script>
                  function filterPencarian(){
                    
                    let filter = document.getElementById("pilihFilter").value;
                    let cariKoordinat = document.getElementById("formCariPosisi");
                    let cariID = document.getElementById("formCariID");
                    let cariKecKel = document.getElementById("formCariKecKel");
                    
                    if(filter == ""){
                      cariKoordinat.style.display='none';
                      cariID.style.display='none';
                      cariKecKel.style.display='none';
                    }else if(filter == "koordinat"){
                      cariKoordinat.style.display='block';
                      cariID.style.display='none';
                      cariKecKel.style.display='none';
                    }else if(filter == "idmenara"){
                      cariKoordinat.style.display='none';
                      cariID.style.display='block';
                      cariKecKel.style.display='none';
                    }else{
                      cariKoordinat.style.display='none';
                      cariID.style.display='none';
                      cariKecKel.style.display='block';
                    }

                    // document.getElementById("demo").innerHTML = "You selected: " + filter;
                  }
                </script>

                
                <form id="formCariPosisi" method="" action="#" style="display: none">
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
                            <input type="button" id="cariPosisi" class="btn btn-main btn-icon btn-round-full mb-3"
                                value="Cari" />
                        </div>
                    </div>
                </form>

                <form id="formCariID" action="/user/peta-makro"
                  @if (request('search')) style="display: block"  
                  @else style="display: none"
                  @endif>
                    <div class="row">
                        <div class="col-md-4">
                            <p>ID Menara</p>
                            <div class="form-group">
                                <input id="search" name="search" type="text" class="form-control"
                                    value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button type="submit" class="btn btn-main btn-round-full mb-3">Cari</button>
                        </div>
                    </div>
                </form>

                <form id="formCariKecKel" method="get" action="/user/peta-makro" enctype="multipart/form-data" 
                  @if (request('kecamatan_id')) style="display: block"  
                  @else style="display: none"
                  @endif>
                  <div class="row">
                    <div class="form-group col-md-4">
                      <p>Kecamatan</p>
                      <select class="form-control" name="kecamatan_id" id="kecamatan" data-dependent="kelurahan">
                          <option value=""> -- Semua kecamatan -- </option>
                          @foreach ($kecamatan as $key => $kec)
                              <option value="{{ $key }}" {{ request('kecamatan_id') == $key ? 'selected' : '' }}>
                                  {{ $kec }}
                              </option>
                          @endforeach
                      </select>
                    </div>

                    <div class="form-group col-md-4">
                      <p>Kelurahan</p>
                      <select class="form-control" name="kelurahan_id" id="kelurahan">
                          <option value=""> -- Semua kelurahan -- </option>
                          @foreach ($kelurahan->where('kecamatan_id','=', request('kecamatan_id')) as $key => $kel)
                              <option value="{{ $key }}" {{ request('kelurahan_id') == $key ? 'selected' : '' }}> 
                                  {{ $kel }}
                              </option>
                          @endforeach
                      </select>
                    </div>

                    <div class="col-md-2 align-self-end">
                      <button type="submit" id="cariKecKel" class="btn btn-main btn-icon btn-round-full mb-3">Cari</button>
                    </div>
                  </div>
                </form>
                            
                <form class="row pl-3">
                  <div class="form-group form-check mr-3">
                    <input type="checkbox" class="form-check-input" id="checkboxTower" checked>
                    <label class="form-check-label" for="checkboxMenara">Tampilkan menara</label>
                  </div>
                  <div class="form-group form-check mr-3">
                    <input type="checkbox" class="form-check-input" id="checkboxZone" checked>
                    <label class="form-check-label" for="checkboxZone">Tampilkan zona</label>
                  </div>
                </form>

              </div>
                
                <div class="form-group">
                    <div id="map_canvas" style="width: auto; height: 600px;"></div>
                </div>
                
                <div class="d-flex navbarTableChart">
                  <div class="col-6 d-flex justify-content-center nav-item"
                    id="navTable" style="border-bottom: solid 4px #e12454;">
                    <a id="linkTable" class="nav-link" style="color: #e12454; font-weight: bold" onclick="showTable()">
                      List
                    </a>
                  </div>
                  <div class="col-6 d-flex justify-content-center nav-item"
                    id="navChart" style="border-bottom: solid 1px #6F8BA4">
                    <a id="linkChart" class="nav-link" style="color: #6F8BA4;" onclick="showChart()">
                      Statistik
                    </a>
                  </div>
                </div>

                <script>
                  function showTable(){
                    
                    let showTable = document.getElementById("towerTable");
                    let showChart= document.getElementById("towerChart");
                    
                    document.getElementById("navTable").style.borderBottom = 'solid 4px #e12454';
                    document.getElementById("linkTable").style.fontWeight='bold';
                    document.getElementById("linkTable").style.color='#e12454';
                    showTable.style.display='block';

                    document.getElementById("navChart").style.borderBottom = 'solid 1px #6F8BA4';
                    document.getElementById("linkChart").style.fontWeight='normal';
                    document.getElementById("linkChart").style.color='#6F8BA4';
                    showChart.style.display='none';
 
                  }

                  function showChart(){
                    
                    let showTable = document.getElementById("towerTable");
                    let showChart = document.getElementById("towerChart");

                    document.getElementById("navChart").style.borderBottom = 'solid 4px #e12454';
                    document.getElementById("linkChart").style.fontWeight='bold';
                    document.getElementById("linkChart").style.color='#e12454';
                    showChart.style.display='block';

                    document.getElementById("navTable").style.borderBottom = 'solid 1px #6F8BA4';
                    document.getElementById("linkTable").style.fontWeight='normal';
                    document.getElementById("linkTable").style.color='#6F8BA4';
                    showTable.style.display='none';

                    //menginisiasi ulang canvas, lalu membuat chart baru
                    document.querySelector("#chartContainer").innerHTML = '<canvas id="doughnutChart"></canvas>';
                    createChart();
 
                  }
                </script>

                <div class="shadow px-3 px-md-4 py-4 mt-4 mb-5" id="towerTable" 
                  style="border-radius: 7px; border-left: solid #223a66 7px">
                    <div class="row d-flex">
                        <div class="col">
                            <h3 class="title-color mb-0">List Menara Makro di
                              @if (request('kelurahan_id') && request('kecamatan_id')) 
                                  {{ $kelurahan[request('kelurahan_id')] }},
                                  {{ $kecamatan[request('kecamatan_id')] }}
                              @elseif (request('kecamatan_id'))
                                  {{ $kecamatan[request('kecamatan_id')] }}
                              @else
                                  Kota Semarang
                              @endif 
                              ({{ $towerMakro->count() }})</h3>
                            <small class="mb-3"><i>Klik baris untuk melihat detail menara</i></small>
                        </div>
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
                            @if ($tabelMakro->count())
                                <tbody>
                                    @foreach ($tabelMakro as $d)
                                        <a href="">
                                            <tr class="clickable-row" data-href="/user/peta-makro/{{ $d->id }}">
                                                <td>{{ $d->idMenara }}</td>
                                                <td>{{ $d->pemilik }}</td>
                                                <td>{{ $d->kelurahan->name }},&nbsp;{{ $d->kecamatan->name }}</td>
                                            </tr>
                                        </a>
                                    @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <td colspan="3" class="text-center justify-content-center">Tidak ada data menara yang
                                        ditemukan</td>
                                </tbody>
                            @endif

                        </table>
                        {{-- paginate --}}
                        {{ $tabelMakro->links() }}
                    </div>
                </div>

                <div class="shadow px-3 px-md-4 py-4 mt-4 mb-5" id="towerChart" 
                  style="display: none; border-radius: 7px; border-left: solid #223a66 7px">
                  <div class="row d-flex">
                    <div class="col mb-3">
                      <h3 class="title-color mb-0">
                        Diagram Persebaran Menara Makro di Kota Semarang
                      </h3>
                      <small><i>Klik diagram untuk melihat jumlah menara</i></small>
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center">
                    <div id="chartContainer" style="min-width: 90%; min-height:480px">
                      <canvas id='doughnutChart'></canvas>                          
                    </div>
                  </div>
                </div>

                <script>
                  function createChart(){

                    let doughnutChart = document.getElementById('doughnutChart').getContext('2d');
                    let myChart;
                    let towers = @json($chartMakro);
                    let data = [];
                    
                    //masukkan jumlah menara tiap kecamatan ke array data dengan mengecek dulu
                    //apakah kecamatan tersebut punya menara (cek kesamaan id kecamatan)
                    let i = 0;
                    let k = 0;
                    for (let kec=1; kec<=16; kec++) {
                        t = towers[i];
                        if(t.kecamatan_id == kec){
                          data[k] = t.jumlah;
                          i++;
                        }else{
                          data[k] = 0;
                        }
                        k++;
                    }

                    myChart = new Chart(doughnutChart, {
                        type: 'doughnut',
                        data: {
                            labels: [
                                "Smg Tengah",
                                "Smg Utara",
                                "Smg Timur",
                                "Gayamsari",
                                "Genuk",
                                "Pedurungan",
                                "Smg Selatan",
                                "Candisari",
                                "Gajahmungkur",
                                "Tembalang",
                                "Banyumanik",
                                "Gunungpati",
                                "Smg Barat",
                                "Mijen",
                                "Ngaliyan",
                                "Tugu"
                            ],
                            datasets: [{
                                label: ["Jumlah menara"],
                                backgroundColor: [
                                    'rgba(246, 242, 14, 0.5)',
                                    'rgba(0, 22, 251, 0.5)',
                                    'rgba(30, 155, 250, 0.5)',
                                    'rgba(215, 39, 57, 0.5)',
                                    'rgba(179, 182, 234, 0.5)',
                                    'rgba(55, 246, 6, 0.5)',
                                    'rgba(195, 114, 216, 0.5)',
                                    'rgba(88, 0, 240, 0.5)',
                                    'rgba(221, 167, 26, 0.5)',
                                    'rgba(124, 72, 21, 0.5)',
                                    'rgba(106, 188, 100, 0.5)',
                                    'rgba(195, 111, 112, 0.5)',
                                    'rgba(37, 80, 164, 0.5)',
                                    'rgba(254, 217, 30, 0.5)',
                                    'rgba(197, 58, 89, 0.5)',
                                    'rgba(39, 40, 143, 0.5)',
                                ],
                                borderColor: [
                                    'rgb(246, 242, 14)',
                                    'rgb(0, 22, 251)',
                                    'rgb(30, 155, 250)',
                                    'rgb(215, 39, 57)',
                                    'rgb(179, 182, 234)',
                                    'rgb(55, 246, 6)',
                                    'rgb(195, 114, 216)',
                                    'rgb(88, 0, 240)',
                                    'rgb(221, 167, 26)',
                                    'rgb(124, 72, 21)',
                                    'rgb(106, 188, 100)',
                                    'rgb(195, 111, 112)',
                                    'rgb(37, 80, 164)',
                                    'rgb(254, 217, 30)',
                                    'rgb(197, 58, 89)',
                                    'rgb(39, 40, 143)',
                                ],
                                hoverOffset: 10,
                                data: data,
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    responsive: true,
                                    fullSize: true,
                                    display: true,
                                    position: 'right'
                                }
                            },
                            layout: {
                              padding: 5
                            }
                            
                        }
                    });

                    if(window.innerWidth <= 425){
                        myChart.options.plugins.legend.position = 'bottom';
                        myChart.update();
                    }else{
                        myChart.options.plugins.legend.position = 'right';
                        myChart.update();
                    }

                    // window.addEventListener('resize', function(){
                    //   if(window.innerWidth <= 425){
                    //     myChart.options.plugins.legend.position = 'bottom';
                    //     myChart.update();
                    //   }else{
                    //     myChart.options.plugins.legend.position = 'right';
                    //     myChart.update();
                    //   }
                    // });
                    
                  }

                </script>
            </div>
        </div>

    </section>
    
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
          if($('#kecamatan').val() == ""){
            $('#kelurahan').empty();
            $('#kelurahan').append('<option value=""> -- Semua kelurahan -- </option>');
          }else{
            var kecamatan_id = $('#kecamatan').val();
            $.ajax({
                type: "GET",
                url: "{{ url('/user/daftar-menara/getKelurahan') }}?kecamatan_id=" + kecamatan_id,
                success: function(res) {
                    if (res) {
                        $('#kelurahan').empty();
                        $('#kelurahan').append(
                            '<option value=""> -- Semua kelurahan -- </option>');
                        $.each(res, function(key, value) {
                            // $('#kelurahan').append('<option value="' + key +
                            //     '">' + value + '</option>');
                            $('#kelurahan').append('<option value="' + key +
                                '" {{ request('kelurahan_id') == ' + key + ' ? 'selected' : '' }}>' +
                                value + '</option>');
                        });
                    } else {
                        $('#kelurahan').empty();
                    }
                }
            });
          }
          $('#kecamatan').change(function() {
              var kecamatan_id = $(this).val();
              if (kecamatan_id) {
                  $.ajax({
                      type: "GET",
                      url: "{{ url('/user/daftar-menara/getKelurahan') }}?kecamatan_id=" + kecamatan_id,
                      success: function(res) {
                          if (res) {
                              $('#kelurahan').empty();
                              $('#kelurahan').append(
                                  '<option value=""> -- Semua kelurahan -- </option>');
                              $.each(res, function(key, value) {
                                  // $('#kelurahan').append('<option value="' + key +
                                  //     '">' + value + '</option>');
                                  $('#kelurahan').append('<option value="' + key +
                                      '" {{ request('kelurahan_id') == ' + key + ' ? 'selected' : '' }}>' +
                                      value + '</option>');
                              });
                          } else {
                              $('#kelurahan').empty();
                          }
                      }
                  });
              } else {
                  $('#kelurahan').empty();
                  $('#kelurahan').append('<option value=""> -- Semua kelurahan -- </option>');
              }
          });
      });
    </script>

    {{-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly&channel=2"
      async
    ></script> --}}
@endsection

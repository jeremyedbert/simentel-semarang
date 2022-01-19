@extends('layouts.main-user')
@section('content')
    <script type="text/javascript"
        {{-- src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvvsS4RB2Kj8LBp0t3yxRtMAhpzZxtKMQ"> //punya jeremy --}}
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8"> //punya willy
    </script>
    <script type="text/javascript">
        function initialize() {
            // Creating map object
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 12,
                center: new google.maps.LatLng(-6.966667, 110.4381),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            // creates a draggable marker to the given coords
            var vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(-6.966667, 110.4381),
                draggable: true
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
    <style>
      label{
        margin-top: 5px;
        margin-bottom: 0;
      }
      .text-danger{
        margin-top: 0;
      }
    </style>
    <section class="section appoinment">
        <div class="container">
            <h2 class="title-color mb-4">Pendaftaran Menara Utama</h2>
            <form id="#" class="appoinment-form" method="post" action="#">
                <div class="col">
                    <div class="form-group">
                        <label>Nama Operator <span style="color: #e12454"><b> * </b></span></label>
                        <input name="operator" type="text" class="form-control" placeholder="contoh: TELKOMSEL">
                    </div>
                    <div class="form-group">
                        <label>Kecamatan <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control" id="kecamatan">
                            <option value=""> -- Pilih kecamatan -- </option>
                            <option value="">Kecamatan 1</option>
                            <option value="">Kecamatan 2</option>
                            <option value="">Kecamatan 3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kelurahan <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control" id="kelurahan">
                            <option value=""> -- Pilih kelurahan -- </option>
                            <option value="">Kelurahan 1</option>
                            <option value="">Kelurahan 2</option>
                            <option value="">Kelurahan 3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tipe Site <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control" id="site">
                            <option value="none"> -- Pilih tipe site -- </option>
                            <option value="greenfield">Greenfield</option>
                            <option value="monopole">Monopole</option>
                            <option value="rooftop">Rooftop Pole</option>
                            <option value="sst">SST</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipe Jalan <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control" id="site">
                            <option value="none"> -- Pilih tipe site -- </option>
                            <option value="greenfield">Greenfield</option>
                            <option value="monopole">Monopole</option>
                            <option value="rooftop">Rooftop Pole</option>
                            <option value="sst">SST</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ketinggian (dalam meter) <span style="color: #e12454"><b> * </b></span></label>
                        <input name="tinggi" type="text" class="form-control" placeholder="contoh: 12">
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label>Latitude <span style="color: #e12454"><b> * </b></span></label>
                            <div class="form-group">
                                <input id="txtLat" name="latitude" type="text" value="-6.966667" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Longitude <span style="color: #e12454"><b> * </b></span></label>
                            <div class="form-group">
                                <input id="txtLng" name="longitude" type="text" value="110.4381" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="map_canvas" style="width: auto; height: 400px;"></div>
                    </div>
                    <div class="form-group">
                        <label>Luas Menara<span style="color: #e12454"><b> * </b></span></label>
                        <input name="pemilik" type="text" class="form-control" placeholder="contoh: 16 x 16 meter2">
                    </div>
                    <div class="form-group">
                        <label>Pemilik Menara <span style="color: #e12454"><b> * </b></span></label>
                        <input name="pemilik" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Penyewa Menara</label>
                        <input name="pemilik" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Nomor IMB</label>
                        <input name="pemilik" type="text" class="form-control" placeholder="">
                    </div>
                    
                    <p style="margin-bottom: 0; color: #e12454"><b>Sebelum submit, silakan cek kembali form yang telah Anda isi</b></p>
                    <p class="mb-4" style="color: #e12454"><b>Apa yang telah Anda isi, tidak dapat diedit.</b></p>
                    <a class="btn btn-main btn-round" href="#">Submit</a>
                </div>
            </form>
        </div>
    </section>
@endsection

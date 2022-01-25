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
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <h2 class="title-color mb-4">Pendaftaran Menara</h2>
            <form id="#" class="appoinment-form" method="post" action="{{ route('user.daftar-menara.createTower') }}">
                <div class="col">
                  @csrf
                    <div class="form-group">
                      <label>Pemilik Menara <span style="color: #e12454"><b> * </b></span></label>
                      <input name="pemilik" type="text" class="form-control input-sm" placeholder="">
                    </div>
                    <div class="form-group">
                      <label>ID Menara <span style="color: #e12454"><b> * </b></span></label>
                      <input name="idMenara" type="text" class="form-control input-sm" placeholder="">
                    </div>
                    <div class="form-group">
                      <label>Tipe Menara <span style="color: #e12454"><b> * </b></span></label>
                      <select class="form-control" name="tipeMenara" id="tipeMenara">
                          <option value="none"> -- Pilih tipe menara -- </option>
                          @foreach ($tipemenara as $menara)
                              <option value="{{ $menara->id }}"> {{ $menara->name }}</option>
                          @endforeach   
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Tipe Site <span style="color: #e12454"><b> * </b></span></label>
                      <select class="form-control" name="tipeSite" id="tipeSite">
                          <option value="none"> -- Pilih tipe site -- </option>
                          @foreach ($tipesite as $site)
                            <option value="{{ $site->id }}"> {{ $site->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label>Tipe Jalan <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control" name="tipeJalan" id="jalan">
                            <option value="none"> -- Pilih tipe jalan -- </option>
                            @foreach ($tipejalan as $jalan)
                              <option value="{{ $jalan->id }}"> {{ $jalan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ketinggian (dalam meter) <span style="color: #e12454"><b> * </b></span></label>
                        <input name="tinggi" type="text" class="form-control" placeholder="contoh: 12">
                    </div>
                    <div class="form-group">
                        <label>Kecamatan <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control" name="kecamatan" id="kecamatan" data-dependent="kelurahan">
                            <option value="none"> -- Pilih kecamatan -- </option>
                            @foreach ($kecamatan as $key => $kec)
                              <option value="{{ $key }}"> {{ $kec }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kelurahan <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control" name="kelurahan" id="kelurahan">
                            <option value="none"> -- Pilih kelurahan -- </option>    
                        </select>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Latitude <span style="color: #e12454"><b> * </b></span></label>
                              <input id="txtLat" name="latitude" type="text" value="-6.966667" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Longitude <span style="color: #e12454"><b> * </b></span></label>
                              <input id="txtLng" name="longitude" type="text" value="110.4381" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="map_canvas" style="width: auto; height: 400px;"></div>
                    </div>
                    <div class="form-group">
                        <label>Luas<span style="color: #e12454"><b> * </b></span></label>
                        <input name="luas" type="text" class="form-control" placeholder="contoh: 16 x 16 meter2">
                    </div>
                    <div class="form-group">
                      <label>Operator</label>
                      <input name="operator" type="text" class="form-control" placeholder="contoh: TELKOMSEL">
                    </div>
                    <div class="form-group">
                        <label>Penyewa Menara</label>
                        <input name="penyewa" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Nomor IMB</label>
                        <input name="nomorIMB" type="text" class="form-control" placeholder="">
                    </div>
                    
                    <p style="margin-bottom: 0; color: #e12454"><b>Sebelum submit, silakan cek kembali form yang telah Anda isi</b></p>
                    <p class="mb-4" style="color: #e12454"><b>Apa yang telah Anda isi, tidak dapat diedit.</b></p>
                    <button class="btn btn-main btn-round-full" type="submit">Ajukan Izin/Pendaftaran</button>
                </div>
            </form>
            
        </div>
    </section>
    <script type="text/javascript">
      $(document).ready(function() {
            $('#kecamatan').change(function() {
               var kecamatanID = $(this).val();
               if(kecamatanID) {
                   $.ajax({
                       type: "GET",
                       url: "{{ url('user/daftar-menara/getKelurahan') }}?idKec="+kecamatanID,
                       success:function(res)
                       {
                         if(res){
                            $('#kelurahan').empty();
                            $('#kelurahan').append('<option value="none"> -- Pilih kelurahan -- </option>'); 
                            $.each(res, function(key, value){
                                $('#kelurahan').append('<option value="'+ key +'">' + value+ '</option>');
                            });
                        }else{
                            $('#kelurahan').empty();
                        }
                     }
                   });
               }else{
                 $('#kelurahan').empty();
               }
            });
            });
      
    </script>
@endsection

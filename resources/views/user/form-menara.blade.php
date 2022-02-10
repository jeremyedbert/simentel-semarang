@extends('layouts.main-user')
@section('content')
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvvsS4RB2Kj8LBp0t3yxRtMAhpzZxtKMQ">
        //punya jeremy
        // src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8"
        //punya willy
    </script>
    <script type="text/javascript">
        function initialize() {
            // Creating map object
            const map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 13,
                center: new google.maps.LatLng(-6.966667, 110.4381),
                // mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            // SVG Icon
            const svgMark = {
                url: "{{ url('/images/tower_marker.svg') }}",
                scaledSize: new google.maps.Size(40, 40), // scaled size
            };

            // creates a draggable marker to the given coords
            let vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(-6.966667, 110.4381),
                animation: google.maps.Animation.DROP,
                icon: svgMark,
                title: "Drag",
                draggable: true
            });

            // adds a listener to the marker
            // gets the coords when drag event ends
            // then updates the input with the new coords
            google.maps.event.addListener(vMarker, 'drag', function(evt) {
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
        label {
            margin-top: 5px;
            margin-bottom: 0;
        }

        .text-danger {
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
            <h2 class="title-color mb-2">Pendaftaran Menara</h2>
            <div class="divider mb-4"></div>
            <form id="#" class="appoinment-form" method="post" action="/user/daftar-menara">
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
                        <select class="form-control" name="tipe_menara_id" id="tipeMenara">
                            <option value="none"> -- Pilih tipe menara -- </option>
                            @foreach ($tipemenara as $menara)
                                <option value="{{ $menara->id }}"> {{ $menara->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipe Site <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control" name="tipe_site_id" id="tipeSite">
                            <option value="none"> -- Pilih tipe site -- </option>
                            @foreach ($tipesite as $site)
                                <option value="{{ $site->id }}"> {{ $site->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipe Jalan <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control" name="tipe_jalan_id" id="jalan">
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
                        <select class="form-control" name="kecamatan_id" id="kecamatan_id" data-dependent="kelurahan_id">
                            <option value="none"> -- Pilih kecamatan -- </option>
                            @foreach ($kecamatan as $key => $kec)
                                <option value="{{ $key }}"> {{ $kec }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kelurahan <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control" name="kelurahan_id" id="kelurahan_id">
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
                        <div id="map_canvas" style="width: auto; height: 300px;"></div>
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

                    <div class="form-group ">
                        <label for="document" class="form-label">Lampiran/Dokumen Pendukung <span
                                style="color: #e12454"><b> * </b></span></label>
                        <input class="form-control pt-2" type="file" name="document" id="document" multiple>

                    </div>
                    <p style="margin-bottom: 0; color: #e12454"><b>Sebelum submit, silakan cek kembali form yang telah Anda
                            isi</b></p>

                    <p class="mb-4" style="color: #e12454"><b>Apa yang telah Anda isi, tidak dapat diedit.</b></p>
                    <button class="btn btn-main btn-round-full" type="submit">Ajukan Izin/Pendaftaran</button>
                </div>
            </form>

        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#kecamatan_id').change(function() {
                var kecamatan_id = $(this).val();
                if (kecamatan_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/user/daftar-menara/getKelurahan') }}?kecamatan_id=" +
                            kecamatan_id,
                        success: function(res) {
                            if (res) {
                                $('#kelurahan_id').empty();
                                $('#kelurahan_id').append(
                                    '<option value="none"> -- Pilih kelurahan -- </option>');
                                $.each(res, function(key, value) {
                                    $('#kelurahan_id').append('<option value="' + key +
                                        '">' + value + '</option>');
                                });
                            } else {
                                $('#kelurahan_id').empty();
                            }
                        }
                    });
                } else {
                    $('#kelurahan_id').empty();
                }
            });
        });
    </script>
@endsection

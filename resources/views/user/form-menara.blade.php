@extends('layouts.main-user')
@section('content')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}">
        //punya jeremy
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

        option {
            padding: 5px 0;
        }

    </style>
    <section class="mt-4">
        <div class="container">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {!! session('success') !!}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <h2 class="title-color mb-2">Pendaftaran Menara</h2>
            <div class="divider mb-4"></div>
            <form id="#" method="post" action="/user/daftar-menara/store" enctype="multipart/form-data">
                <div class="col mb-5">
                    @csrf
                    <div class="form-group">
                        <label>Pemilik Menara <span style="color: #e12454"><b> * </b></span></label>
                        <input name="pemilik" type="text"
                            class="form-control input-sm @error('pemilik') is-invalid @enderror"
                            value='{{ old('pemilik') }}' placeholder="contoh: PT Telkom Indonesia Tbk">
                        <span class="text-danger">
                            @error('pemilik')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label>ID Menara <span style="color: #e12454"><b> * </b></span></label>
                        <input name="idMenara" type="text"
                            class="form-control input-sm @error('idMenara') is-invalid @enderror"
                            value='{{ old('idMenara') }}' placeholder="contoh: TLKM-SMG_123">
                        <span class="text-danger">
                            @error('idMenara')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Tipe Menara <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control @error('tipe_menara_id') is-invalid @enderror" name="tipe_menara_id"
                            id="tipeMenara">
                            <option value=""> -- Pilih tipe menara -- </option>
                            @foreach ($tipemenara as $menara)
                                <option value="{{ $menara->id }}"
                                    {{ old('tipe_menara_id') == $menara->id ? 'selected' : '' }}> {{ $menara->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('tipe_menara_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Tipe Site <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control @error('tipe_site_id') is-invalid @enderror" name="tipe_site_id"
                            id="tipeSite">
                            <option value=""> -- Pilih tipe site -- </option>
                            @foreach ($tipesite as $site)
                                <option value="{{ $site->id }}"
                                    {{ old('tipe_site_id') == $site->id ? 'selected' : '' }}> {{ $site->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('tipe_site_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Tipe Jalan <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control @error('tipe_jalan_id') is-invalid @enderror" name="tipe_jalan_id"
                            id="jalan">
                            <option value=""> -- Pilih tipe jalan -- </option>
                            @foreach ($tipejalan as $jalan)
                                <option value="{{ $jalan->id }}"
                                    {{ old('tipe_jalan_id') == $jalan->id ? 'selected' : '' }}> {{ $jalan->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('tipe_jalan_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Ketinggian (dalam meter) <span style="color: #e12454"><b> * </b></span></label>
                        <input name="tinggi" id="tinggi" type="text"
                            class="form-control @error('tinggi') is-invalid @enderror" value='{{ old('tinggi') }}'
                            placeholder="contoh: 12.5">
                        <span class="text-danger">
                            @error('tinggi')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Luas (dalam meter&sup2; atau panjang x lebar)<span style="color: #e12454"><b> *
                                </b></span></label>
                        <input name="luas" id="luas" type="text" class="form-control @error('luas') is-invalid @enderror"
                            value='{{ old('luas') }}' placeholder="contoh: 16 x 16 meter2">
                        <span class="text-danger">
                            @error('luas')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Kecamatan <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control @error('kecamatan_id') is-invalid @enderror" name="kecamatan_id"
                            id="kecamatan" data-dependent="kelurahan">
                            <option value=""> -- Pilih kecamatan -- </option>
                            @foreach ($kecamatan as $key => $kec)
                                <option value="{{ $key }}"
                                    {{ old('kecamatan_id') == $key ? 'selected' : '' }}> {{ $kec }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('kecamatan_id')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>
                    {{-- Kelurahan --}}
                    <div class="form-group">
                        <label>Kelurahan <span style="color: #e12454"><b> * </b></span></label>
                        <select class="form-control @error('kelurahan_id') is-invalid @enderror" name="kelurahan_id"
                            id="kelurahan">
                            <option value=""> -- Pilih kelurahan -- </option>
                        </select>
                        <span class="text-danger">
                            @error('kelurahan_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    {{-- Koordinat --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Latitude <span style="color: #e12454"><b> * </b></span></label>
                                <input id="txtLat" name="latitude" type="text"
                                    class="form-control @error('latitude') is-invalid @enderror"
                                    value='{{ old('latitude') }}' placeholder="contoh: -6.966667">
                                <span class="text-danger">
                                    @error('latitude')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Longitude <span style="color: #e12454"><b> * </b></span></label>
                                <input id="txtLng" name="longitude" type="text"
                                    class="form-control @error('longitude') is-invalid @enderror"
                                    value='{{ old('longitude') }}' placeholder="contoh: 110.4381">
                                <span class="text-danger">
                                    @error('longitude')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- Map --}}
                    <div class="form-group">
                        <div id="map_canvas" style="width: auto; height: 300px;"></div>
                    </div>
                    {{-- Operator --}}
                    <div class="form-group">
                        <label>Operator</label>
                        <input name="operator" type="text" class="form-control" value='{{ old('operator') }}'
                            placeholder="">
                    </div>
                    {{-- Penyewa --}}
                    <div class="form-group">
                        <label>Penyewa Menara</label>
                        <input name="penyewa" type="text" class="form-control" value='{{ old('penyewa') }}'
                            placeholder="">
                    </div>
                    {{-- No IMB --}}
                    <div class="form-group">
                        <label>Nomor IMB</label>
                        <input name="nomorIMB" type="text" class="form-control" value='{{ old('nomorIMB') }}'
                            placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="document" class="form-label">Lampiran/Dokumen Pendukung <span
                                style="color: #e12454"><b> * </b></span></label>
                        {{-- <input class="form-control pt-2" type="file" name="document" id="document"> --}}
                        <input class="form-control @error('longitude') is-invalid @enderror" type="file" name="document" id="document">
                        <span class="text-danger">
                            @error('document')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <p style="color: #e12454"><b>Sebelum submit, silakan cek kembali
                            form yang telah Anda isi. Anda tidak bisa melakukan perubahan pendaftaran setelah menekan
                            "Ajukan Izin/Pendaftaran".</b></p>

                    {{-- <p class="mb-4" style="color: #e12454"><b></b></p> --}}
                    <button class="btn btn-main btn-round-full" type="submit">Ajukan Izin/Pendaftaran</button>
                </div>
            </form>

        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#kecamatan').change(function() {
                var kecamatan_id = $(this).val();
                if (kecamatan_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/user/daftar-menara/getKelurahan') }}?kecamatan_id=" +
                            kecamatan_id,
                        success: function(res) {
                            if (res) {
                                $('#kelurahan').empty();
                                $('#kelurahan').append(
                                    '<option value=""> -- Pilih kelurahan -- </option>');
                                $.each(res, function(key, value) {
                                    // $('#kelurahan').append('<option value="' + key +
                                    //     '">' + value + '</option>');
                                    $('#kelurahan').append('<option value="' + key +
                                        '" {{ old('kelurahan_id') == ' + key + ' ? 'selected' : '' }}>' +
                                        value + '</option>');
                                });
                            } else {
                                $('#kelurahan').empty();
                            }
                        }
                    });
                } else {
                    $('#kelurahan').empty();
                }
            });
        });
    </script>
    <script>
        //   const inputElement = document.querySelector('input[id="document"]');
        //   const pond = FilePond.create(inputElement);
        //   FilePond.setOptions({
        //     server:{ 
        //       url: "/user/daftar-menara/upload",
        //       headers:{
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //       }
        //     } 
        //   });
    </script>
@endsection

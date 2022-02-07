@extends('layouts.main-user')
@section('content')

<script type="text/javascript" {{-- src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvvsS4RB2Kj8LBp0t3yxRtMAhpzZxtKMQ"> //punya jeremy --}}
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8">
  //punya willy
</script>
<script>
  function initialize() {
      // Creating map object
      var lat = document.getElementById('txtLat').innerHTML;
      var lng = document.getElementById('txtLng').innerHTML;
      // const uluru = {
      //     lat: -7.095,
      //     lng: 110.095
      // };
      var map = new google.maps.Map(document.getElementById('map_canvas'), {
          zoom: 15,
          // center: new google.maps.LatLng(-7.09275, 110.32743),
          scrollwheel: false,
          center: new google.maps.LatLng(lat, lng),
          // center: uluru,
          mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      // creates a draggable marker to the given coords
      var vMarker = new google.maps.Marker({
          position: new google.maps.LatLng(lat, lng),
          // position: uluru,
          draggable: false
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
  .user-profile{
    background-color: #223a66;
    color: #fafafa;
  }
  .user-icon{
    font-size: 120pt;
  }
  .nama-user{
    color: #fafafa;
  }
  .detail h6{
    text-align: end;
    margin-bottom: 0;
  }
  
  @media (max-width:425px){
    .id-tgl{
      flex-direction: column;
    }
  }
</style>
<section>
    <div class="d-flex row d-inline-block mb-5">
        <div class="col-lg-4 d-flex justify-content-lg-end ml-0" style="height:min-content">

            <div class="col-lg-8 user-profile shadow px-3 py-4 mb-5 mx-4 bg-body" style="border-radius: 20px">
                <div class="material-icons-outlined user-icon d-flex justify-content-center mb-3" id="">account_circle</div>
              {{-- <i class="icofont-business-man-alt-1"></i> --}}
                <div class="col px-auto">
                  <div class="d-flex justify-content-center">
                    <h3 class="nama-user">
                      {{ auth()->user()->name }}
                    </h3>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <span class="material-icons-outlined mr-2">
                      email
                    </span>
                    <span>
                      {{ auth()->user()->email }}
                    </span>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <span class="material-icons-outlined mr-2">
                      phone_iphone
                    </span>
                      {{ auth()->user()->phone }}
                  </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mx-auto" style=" min-height: 80vh ">
            <div class="col-lg-11 pl-lg-0">
              <h2 class="title-color mb-2">Detail Permohonan</h2>
              <div class="divider mb-4"></div>
              {{-- <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Edit Form <span><a style="color: #ffa534" data-toggle="tooltip" data-placement="right"
                                        title="Anda hanya bisa mengubah beberapa data."><i class="fas fa-info-circle"></i></a></span></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title"><b>No. Tiket: {{ $data->id }}</b></div>
                                        <div class="card-title">{{ $data->tower->idMenara }}</div>
                                    </div>
      
                                    <form action="/admin/pendaftaran/{{ $data->id }}" method="post">
                                        @method('put')
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pemilik">Pemilik</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->tower->pemilik }}" id="pemilik" name="pemilik"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="tinggi">Tinggi</label>
                                                        <div class="input-group mb-3">
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
                                                        <input type="text" class="form-control" value="{{ $data->tower->luas }}"
                                                            id="luas" name="luas" readonly>
                                                    </div>
                                                </div>
                                            </div>
        
                                          
                                            <div class="row">
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
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->tower->latitude }}" id="txtLat" name="latitude">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="longitude">Longitude</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->tower->longitude }}" id="txtLng" name="longitude">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div id="map_canvas" style="width: auto; height: 400px;"></div>
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
                                                <textarea class="form-control" id="kondisi" name="kondisi" rows="4"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="penyewa">Penyewa</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->tower->penyewa }}" id="penyewa" name="penyewa">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="noimb">No IMB</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $data->tower->noIMB }}" id="nomorIMB" name="nomorIMB">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-action">
                                            <button class="btn btn-success" type="submit">Simpan</button>
                                            <a class="btn btn-danger" href="/admin/pendaftaran">Batal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div> --}}
              
              <div class="detail">
                <div class="col-lg-12 shadow py-4 mb-3" 
                  @if ( $data->status->id === 1) style="border-radius: 7px; border-left: #ffc107 solid 7px"
                  @elseif ( $data->status->id === 2) style="border-radius: 7px; border-left: #28a745 solid 7px"
                  @else style="border-radius: 7px; border-left: #dc3545 solid 7px"
                  @endif
                >
                  <div class="mx-3 mb-4 pb-2" style="border-bottom: #bac6d1 solid 1px">
                    <div>
                      <h3>
                        @if ( $data->status->id === 1)
                          <span class="badge bg-warning text-dark" style="opacity: 0.75">{{ $data->status->name}}</span>
                        @elseif ( $data->status->id === 2)
                          <span class="badge bg-success" style="opacity: 0.75; color: white">{{ $data->status->name}}</span>
                        @else
                          <span class="badge bg-danger" style="opacity: 0.75; color: white">{{ $data->status->name}}</span>
                        @endif 
                      </h3>
                      @if ( $data->status->id === 1)
                        <p style="color: black" class="mb-2"><i>Harap tunggu, permohonan izin menara Anda sedang kami tinjau.</i></p>
                      @elseif ( $data->status->id === 2)
                        <p style="color: black" class="mb-2"><i>Permohonan izin menara Anda telah disetujui pada 
                          {{ ltrim($data->created_at->translatedFormat('d F Y'), '0')}}.</i></p>
                      @else
                        <p style="color: black" class="mb-2"><i>Maaf, permohonan izin menara Anda ditolak pada 
                          {{ ltrim($data->created_at->translatedFormat('d F Y'), '0')}}.</i></p>
                      @endif 
                      
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      ID Permohonan
                      <h6>{{ $data->id }}</h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Tanggal Pengajuan
                      <h6>{{ ltrim($data->created_at->translatedFormat('d F Y'), '0')}}</h6>  
                    </div>
                  </div>

                  <div class="mx-3 mb-4 pb-2" style="border-bottom: #bac6d1 solid 1px">
                    <div>
                      <h5>Detail Menara</h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      ID Menara
                      <h6>{{ $data->tower->idMenara }}</h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Pemilik
                      <h6>{{ $data->tower->pemilik }}</h6>   
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Operator
                      <h6>
                        @if ($data->tower->operator === NULL)
                          -
                        @else
                          {{ $data->tower->operator }}  
                        @endif
                      </h6>   
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Penyewa
                      <h6>
                        @if ($data->tower->penyewa === NULL)
                          -
                        @else
                          {{ $data->tower->penyewa }}  
                        @endif
                      </h6> 
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Tipe Menara
                      <h6>{{ $data->tower->tipemenara->name }}</h6>   
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Tipe Site
                      <h6>{{ $data->tower->tipesite->name }}</h6>   
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Tipe Jalan
                      <h6>{{ $data->tower->tipejalan->name }}</h6>   
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Ketinggian
                      <h6>{{ $data->tower->tinggi}} meter</h6>   
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Luas
                      <h6>{{ $data->tower->luas}}</h6>   
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Nomor IMB
                      <h6>
                        @if ($data->tower->nomorIMB === NULL)
                          -
                        @else
                          {{ $data->tower->nomorIMB }}  
                        @endif
                      </h6>    
                    </div>
                  </div>
                  <div class="mx-3 mb-4 pb-2">
                    <div>
                      <h5>Lokasi Menara</h5>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Kecamatan
                      <h6>{{ $data->tower->kecamatan->name }}</h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Kelurahan
                      <h6>{{ $data->tower->kelurahan->name }}</h6>   
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Latitude
                      <h6 id="txtLat" name="latitude">{{ $data->tower->latitude }}</h6>   
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 mx-md-3">
                      Longitude
                      <h6 id="txtLng" name="longitude">{{ $data->tower->longitude }}</h6>   
                    </div>
                    <div class="mx-md-3 mt-3">
                      <div id="map_canvas" style="width: auto; height: 300px;"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>
  
@endsection
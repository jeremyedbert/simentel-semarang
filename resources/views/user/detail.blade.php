@extends('layouts.main-user')
@section('content')

<script type="text/javascript" {{-- src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvvsS4RB2Kj8LBp0t3yxRtMAhpzZxtKMQ"> //punya jeremy --}}
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8">
  //punya willy
</script>
<script>
  function initialize() {
      // Creating map object
      var lat = document.getElementById('txtLat').value;
      var lng = document.getElementById('txtLng').value;
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
              
              
            </div>
        </div>
    </div>
</section>
  
@endsection
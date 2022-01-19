@extends('layouts.main-user')
@section('content')
    {{-- <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvvsS4RB2Kj8LBp0t3yxRtMAhpzZxtKMQ"> //punya jeremy
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8"> //punya willy
        
    </script> --}}
    {{-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg"
    ></script> --}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
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

        function initMap() {
            const map = new google.maps.Map(document.getElementById("map_canvas"), {
            zoom: 8,
            center: { lat: -6.966667, lng: 110.4381 },
            });
            const geocoder = new google.maps.Geocoder();
            const infowindow = new google.maps.InfoWindow();
        
            document.getElementById("submit").addEventListener("click", () => {
            geocodeLatLng(geocoder, map, infowindow);
            });
        }
  
        function geocodeLatLng(geocoder, map, infowindow) {

            const inputLat = document.getElementById("txtLat").value;
            const inputLng = document.getElementById("txtLng").value;
            // const latlngStr = input.split(",", 2);
            const latlng = {
              lat: parseFloat(inputLat),
              lng: parseFloat(inputLng),
            };
        
            geocoder
            .geocode({ location: latlng })
            .then((response) => {
                if (response.results[0]) {
                map.setZoom(11);
        
                const marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                });
        
                infowindow.setContent(response.results[0].formatted_address);
                infowindow.open(map, marker);
                } else {
                window.alert("No results found");
                }
            })
            .catch((e) => window.alert("Geocoder failed due to: " + e));
        }
            
    </script>
    <style>
        p{
            margin-top:0;
            margin-bottom:0;
        }
    </style>
    <section class="section appoinment">
        <div class="container">
            <h2 class="title-color mb-4">Peta Menara Utama</h2>
            <form id="#" class="appoinment-form" method="post" action="#">
                <div class="col">

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <p>Latitude <span style="color: #e12454"><b> * </b></span></p>
                            <div class="form-group">
                                <input id="txtLat" name="latitude" type="text" value="-6.966667" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p>Longitude <span style="color: #e12454"><b> * </b></span></p>
                            <div class="form-group">
                                <input id="txtLng" name="longitude" type="text" value="110.4381" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 align-self-end">
                            <input type="button" id="submit" class="btn btn-main btn-icon btn-round-full mb-4" value="Cari"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="map_canvas" style="width: auto; height: 500px;"></div>
                    </div>

                    {{-- <p style="margin-bottom: 0; color: #e12454"><b>Sebelum submit, silakan cek kembali form yang telah Anda isi</b></p>
                    <p class="mb-4" style="color: #e12454"><b>Apa yang telah Anda isi, tidak dapat diedit.</b></p>
                    <a class="btn btn-main btn-round" href="#">Submit</a> --}}
                </div>
            </form>
        </div>
    </section>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8&callback=initMap&v=weekly&channel=2"
      async
    ></script>
    {{-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly&channel=2"
      async
    ></script> --}}
@endsection
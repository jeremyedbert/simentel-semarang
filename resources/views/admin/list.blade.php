@extends('layouts.main-admin')
@section('content')
    <script type="text/javascript" {{-- src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvvsS4RB2Kj8LBp0t3yxRtMAhpzZxtKMQ"> //punya jeremy --}}
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8">
        //punya willy
    </script>
    <script type="text/javascript">
        function initialize() {
            // Creating map object
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 12,
                center: new google.maps.LatLng(-7.09275, 110.32743),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            // creates a draggable marker to the given coords
            var vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(-7.09275, 110.32743),
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

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Permohonan</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id Tower</th>
                                                <th>Pemilik</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
                                                <th>Tipe Menara</th>
                                                <th>Info Lengkap</th>
                                                <th>Lampiran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $d)
                                                <tr>
                                                    <td>{{ $d->pendaftaran->tower->idMenara }}</td>
                                                    <td>{{ $d->pendaftaran->tower->pemilik }}</td>
                                                    <td>{{ $d->pendaftaran->tower->latitude }}</td>
                                                    <td>{{ $d->pendaftaran->tower->longitude }}</td>
                                                    <td>{{ $d->pendaftaran->tower->tipemenara->name }}</td>
                                                    <td><a href="#" data-toggle="modal"
                                                            data-target="#modalPermohonan">Detail <i
                                                                class="fas fa-chevron-right"></i></a></td>
                                                    <td><a href="#">Dokumen <i class="fas fa-chevron-right"></i></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="modalPermohonan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle"><b>SMG454</b></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><b>Pemilik Menara <span style="color: #e12454"> *
                                    </span></b></label>
                            <p>PT Dayamitra Telekomunikasi</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"><b>Jenis Menara <span style="color: #e12454"> *
                                    </span></b></label>
                            <p>Makro</p>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1"><b>Latitude <span style="color: #e12454"> *
                                            </span></b></label>
                                    <input id="txtLat" type="text" class="form-control" value="-7.09275">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1"><b>Longitude <span style="color: #e12454"> *
                                            </span></b></label>
                                    <input id="txtLng" type="text" class="form-control" value="110.32743">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="map_canvas" style="width: auto; height: 300px;"></div>
                        </div>
                        <div class="form-group">
                            <label for="tipemenara"><b>Tipe Menara <span style="color: #e12454"> * </span></b></label>
                            <select class="form-control input-square" id="site">
                                <option value="none"> -- Pilih tipe site -- </option>
                                <option value="greenfield" selected>Greenfield</option>
                                <option value="monopole">Monopole</option>
                                <option value="rooftop">Rooftop Pole</option>
                                <option value="sst">SST</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tinggi"><b>Tinggi Menara <span style="color: #e12454"> * </span></b></label>
                            <p>52 meter</p>
                        </div>
                        <div class="form-group">
                            <label for="tinggi"><b>Tinggi Menara <span style="color: #e12454"> * </span></b></label>
                            <p>52 meter</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable();
        })
    </script>
    {{-- <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
@endsection

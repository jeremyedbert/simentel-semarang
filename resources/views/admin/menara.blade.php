@extends('layouts.main-admin')
@section('content')
    <script type="text/javascript" {{-- src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvvsS4RB2Kj8LBp0t3yxRtMAhpzZxtKMQ"> //punya jeremy --}}
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8">
        //punya willy
    </script>


    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Menara</h4>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('decline'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! session()->get('decline') !!}
                    </div>
                @endif
                @if (session()->has('accept'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! session()->get('accept') !!}
                    </div>
                @endif
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $d)
                                                <tr>
                                                    <td>{{ $d->idMenara }}</td>
                                                    <td>{{ $d->pemilik }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-info btn-xs mx-1 my-1" data-toggle="modal"
                                                            data-target="#{{ $d->id }}"><span><i class="fas fa-eye"></i></span> Info</a>
                                                        <a href="#" class="btn btn-warning btn-xs mx-1 my-1" data-toggle="modal"
                                                            data-target="#{{ $d->id }}"><span><i
                                                                    class="fas fa-edit"></i></span> Edit</a>
                                                        <a href="#" class="btn btn-danger btn-xs mx-1 my-1" data-toggle="modal"
                                                            data-target="#del{{ $d->id }}"><span><i
                                                                    class="fas fa-trash-alt"></i></span> Hapus</a>
                                                    </td>
                                                </tr>

                                                {{-- Modal Decline --}}
                                                <div class="modal fade bd-example-modal-sm" id="{{ $d->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div style="text-align: center">
                                                                    <h3>Setelah Anda menolak, Anda tidak dapat
                                                                        mengembalikannya lagi.
                                                                    </h3>
                                                                    <h3><b>Lanjutkan?</b></h3>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-default btn-border btn-sm"
                                                                    data-dismiss="modal">Tidak</button>
                                                                <form
                                                                    action="/admin/pendaftaran/{{ $d->id }}/decline"
                                                                    method="post" class="d-inline">
                                                                    @csrf
                                                                    <button class="btn btn-danger btn-sm">Ya</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End of modal --}}

                                                {{-- Modal Accept --}}
                                                <div class="modal fade bd-example-modal-sm" id="acc{{ $d->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div style="text-align: center">
                                                                    <h3>Yakin untuk menerima?
                                                                    </h3>
                                                                    <small><b>Cek kembali detail</b></small>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-default btn-border btn-sm"
                                                                    data-dismiss="modal">Tidak</button>
                                                                <form action="/admin/pendaftaran/{{ $d->id }}/accept"
                                                                    method="post" class="d-inline">
                                                                    @csrf
                                                                    <button class="btn btn-success btn-sm">Ya</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End of modal --}}
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


    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable();
        })
    </script>
    {{-- <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}

    <ul class="nav nav-pills nav-secondary">
        <li class="nav-item">
            <a class="nav-link active" href="#">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li>
    </ul>
@endsection

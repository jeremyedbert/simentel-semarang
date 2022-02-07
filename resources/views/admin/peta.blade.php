@extends('layouts.main-admin')
@section('content')
    <script type="text/javascript" {{-- src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvvsS4RB2Kj8LBp0t3yxRtMAhpzZxtKMQ"> //punya jeremy --}}
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoDVlS58M0lMm79-lA61YGZhtngOW7hP8">
        //punya willy
    </script>
    <style>
        .nav-pills>li>.nav-link {
            margin-left: 0px
        }

    </style>

    {{-- View ini dipakai oleh menara macro dan micro --}}
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header" style="border-bottom: 1px solid #aaaaaa;">
                    <h1 style="color: black" class="pb-3"><b>Peta Menara
                            {{ Request::is('admin/peta/makro') ? 'Utama' : 'Mikro' }}</b>
                    </h1>
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
                        <ul class="nav nav-pills nav-primary mb-3 justify-content-center">
                            <li class="nav-item submenu">
                                <a href="/admin/menara/{{ $routes === 'macro' ? 'makro' : 'mikro' }}"
                                    class="nav-link {{ Request::is('admin/menara*') ? 'active' : '' }}">Tabel</a>
                            </li>
                            <li class="nav-item submenu">
                                <a href="/admin/peta/{{ $routes === 'macro' ? 'makro' : 'mikro' }}"
                                    class="nav-link {{ Request::is('admin/peta*') ? 'active' : '' }}">Peta</a>
                            </li>
                        </ul>
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
                                                        <a href="/admin/menara/{{ Request::is('admin/menara/makro') ? 'makro' : 'mikro' }}/{{ $d->id }}"
                                                            class="btn btn-info btn-xs mx-1 my-1"><span><i
                                                                    class="fas fa-eye"></i></span> Info</a>
                                                        <a href="#" class="btn btn-danger btn-xs mx-1 my-1"
                                                            data-toggle="modal"
                                                            data-target="#del{{ $d->id }}"><span><i
                                                                    class="fas fa-trash-alt"></i></span> Hapus</a>
                                                    </td>
                                                </tr>

                                                {{-- Modal Hapus --}}
                                                <div class="modal fade bd-example-modal-sm" id="del{{ $d->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h2 class="modal-title" id="exampleModalLongTitle">
                                                                    Konfirmasi Hapus</h2>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <b>Hapus menara ini? </b><a
                                                                        href="/admin/menara/{{ $d->id }}/edit"><small>Cek
                                                                            kembali detail</small></a>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light btn-sm"
                                                                    data-dismiss="modal">Tidak</button>
                                                                <form action="/admin/menara/{{ $d->id }}"
                                                                    method="post" class="d-inline">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button class="btn btn-danger btn-sm">Hapus</button>
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
    {{-- <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
@endsection

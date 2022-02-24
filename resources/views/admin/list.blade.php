@extends('layouts.main-admin')
@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h1 style="color: black" class="pb-3"><b>Permohonan</b> <span class="badge badge-warning ml-2">Sedang ditinjau</span></h1>
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
                                                <th>Tanggal Daftar</th>
                                                <th>Tipe Menara</th>
                                                <th>Lampiran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $d)
                                                <tr>
                                                    <td>{{ $d->tower->idMenara }}</td>
                                                    <td>{{ $d->tower->pemilik }}</td>
                                                    <td>{{ $d->created_at->translatedFormat('d F Y') }}</td>
                                                    <td>{{ $d->tower->tipemenara->name }}</td>
                                                    <td><a href="{{ asset('storage/' . $d->document) }}" target="blank"><i class="far fa-file-alt"></i> Dokumen</a></td>
                                                    <td>
                                                        <a href="/admin/pendaftaran/{{ $d->id }}/edit"
                                                            class="btn btn-warning btn-xs my-1 mx-1"><span><i
                                                                    class="fas fa-eye"></i></span> Detail &
                                                            Edit</a>
                                                        <a href="#" class="btn btn-danger btn-xs my-1 mx-1"
                                                            data-toggle="modal" data-target="#{{ $d->id }}"><span><i
                                                                    class="fas fa-times"></i></span> Tolak</a>
                                                        <a href="#" class="btn btn-success btn-xs my-1 mx-1"
                                                            data-toggle="modal"
                                                            data-target="#acc{{ $d->id }}"><span><i
                                                                    class="fas fa-check"></i></span> Terima</a>
                                                    </td>
                                                </tr>

                                                {{-- Modal Decline --}}
                                                <div class="modal fade bd-example-modal-sm" id="{{ $d->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h2 class="modal-title" id="exampleModalLongTitle">
                                                                    Konfirmasi Penolakan</h2>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <h4><b>Tolak pendaftaran ini?</b></h4>
                                                                    <p class="mb-0">Setelah Anda menolak, Anda
                                                                        tidak dapat mengembalikannya lagi. <a
                                                                            href="/admin/pendaftaran/{{ $d->id }}/edit">Cek
                                                                            kembali detail</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light btn-sm"
                                                                    data-dismiss="modal">Tidak</button>
                                                                <form
                                                                    action="/admin/pendaftaran/{{ $d->id }}/decline"
                                                                    method="post" class="d-inline">
                                                                    @csrf
                                                                    <button class="btn btn-danger btn-sm">Tolak</button>
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
                                                            <div class="modal-header">
                                                                <h2 class="modal-title" id="exampleModalLongTitle">
                                                                    Konfirmasi Penerimaan</h2>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <h4><b>Terima pendaftaran ini? </b></h4>
                                                                    <a href="/admin/pendaftaran/{{ $d->id }}/edit">Cek
                                                                            kembali detail</a>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light btn-sm"
                                                                    data-dismiss="modal">Tidak</button>
                                                                <form
                                                                    action="/admin/pendaftaran/{{ $d->id }}/accept"
                                                                    method="post" class="d-inline">
                                                                    @csrf
                                                                    <button class="btn btn-success btn-sm">Terima</button>
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
@endsection

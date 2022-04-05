@extends('layouts.main-admin')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h1 style="color: black" class="pb-3"><b>Data Pengguna</b></h1>
                </div>

                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="/admin/kelola-user"> <i class="fas fa-chevron-left"></i> Kembali ke daftar pengguna</a>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <div class="card-title">Test</div>
                            </div> --}}
                            <div class="card-body">
                                <table class="table table-typo">
                                    <tbody>
                                        <tr>
                                            <td>Nama</td>
                                            <td>{{ $data->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $data->email }}</td>
                                        </tr>
                                        <tr style="border-bottom: 0px">
                                            <td>No HP</td>
                                            <td>{{ $data->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-action">
                                <a class="btn btn-warning" href="/admin/kelola-user/{{ $data->id }}/edit">Edit</a>
                                <button class="btn btn-danger" data-toggle="modal"
                                    data-target="#{{ $data->id }}">Hapus</button>
                            </div>
                            {{-- Modal Decline --}}
                            <div class="modal fade bd-example-modal-sm" id="{{ $data->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title" id="exampleModalLongTitle">
                                                Konfirmasi Hapus</h2>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <h4><b>Hapus pengguna "{{ $data->name }}"?</b></h4>
                                                <p class="mb-0">Pengguna yang telah dihapus tidak dapat
                                                    dikembalikan.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light btn-sm"
                                                data-dismiss="modal">Batal</button>
                                            <form action="/admin/kelola-user/{{ $data->id }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End of modal --}}
                        </div>
                        
                        {{-- Alamat --}}
                        {{-- <div class="row">
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
                                            <input type="text" class="form-control" value="{{ $data->tower->latitude }}"
                                                id="txtLat" name="latitude">
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
                                                value="{{ $data->tower->tipesite->name }}" id="tipesite" name="tipesite"
                                                readonly>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="penyewa">Penyewa</label>
                                            <input type="text" class="form-control" value="{{ $data->tower->penyewa }}"
                                                id="penyewa" name="penyewa">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="operator">Operator</label>
                                            <input type="text" class="form-control"
                                                value="{{ $data->tower->operator }}" id="operator" name="operator">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="noimb">No IMB</label>
                                            <input type="text" class="form-control" value="{{ $data->tower->noIMB }}"
                                                id="nomorIMB" name="nomorIMB">
                                        </div>
                                    </div>
                                </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main-admin')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Data Pengguna</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="/admin/kelola-user/{{ $data->id }}" method="post">
                                @method('put')
                                @csrf
                                <div class="card-body" style="border-bottom: 1px solid #f3f3f3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Nama</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name', $data->name) }}" id="name" name="name">
                                                @error('name')
                                                    <small style="color: #dc3545">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password Pengguna</label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror" value=""
                                                    id="password" name="password">
                                                <small class="form-text text-muted">Isi jika ingin melakukan perubahan
                                                    password.</small>
                                                @error('password')
                                                    <small style="color: #dc3545">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="phone">Nomor HP</label>
                                                <input type="text"
                                                    class="form-control  @error('phone') is-invalid @enderror"
                                                    value="{{ old('phone', $data->phone) }}" id="phone" name="phone">
                                                @error('phone')
                                                    <small style="color: #dc3545">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Konfirmasi Password Pengguna</label>
                                                <input type="password"
                                                    class="form-control @error('cpassword') is-invalid @enderror" value=""
                                                    id="cpassword" name="cpassword">
                                                <small class="form-text text-muted">Isi jika ingin melakukan perubahan
                                                    password.</small>
                                                @error('cpassword')
                                                    <small style="color: #dc3545">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="luas">Email</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email', $data->email) }}" id="email" name="email">
                                                @error('email')
                                                    <small style="color: #dc3545">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <hr> --}}
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="password_admin">Password Anda (Admin)</label>
                                                <input type="password"
                                                    class="form-control @error('password_admin') is-invalid @enderror"
                                                    value="" id="password_admin" name="password_admin">
                                                <small class="form-text text-muted">Memastikan bahwa perubahan data pengguna
                                                    hanya dilakukan oleh admin.</small>
                                                {{-- @if (session()->has('error'))
                                                    <small style="color: #dc3545">Password admin tidak sesuai.</small>
                                                @endif --}}
                                                @error('password_admin')
                                                    <small style="color: #dc3545">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button class="btn btn-success" type="submit">Simpan</button>
                                    {{-- <button class="btn btn-danger">Cancel</button> --}}
                                    <a class="btn btn-danger" href="/admin/kelola-user">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $data->name }}"
                                                    id="name" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="luas">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $data->email }}"
                                                    id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="phone">Nomor HP</label>
                                                <input type="text" class="form-control  @error('phone') is-invalid @enderror" value="{{ $data->phone }}"
                                                    id="phone" name="phone">
                                                @error('phone')
                                                    <small>{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password Pengguna</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" value="" id="password"
                                                    name="password">
                                                <small class="form-text text-muted">Isi jika ingin melakukan perubahan
                                                    password.</small>
                                                
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
                                                <input type="password" class="form-control" value="" id="password_admin"
                                                    name="password_admin">
                                                <small class="form-text text-muted">Memastikan bahwa perubahan data pengguna
                                                    hanya dilakukan oleh admin.</small>
                                                @if (session()->has('error'))
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
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

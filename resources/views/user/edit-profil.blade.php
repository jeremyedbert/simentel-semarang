@extends('layouts.main-user')
@section('content')
    <style>
        label {
            margin-top: 5px;
            margin-bottom: 0;
        }

        .user-profile {
            background-color: #223a66;
            color: #fafafa;
        }

        .user-icon {
            font-size: 120pt;
        }

        .nama-user {
            color: #fafafa;
        }

        .detail h6 {
            text-align: end;
            margin-bottom: 0;
            /* font-weight: normal; */
        }

        .striped {
            background-color: #fafafa;
        }

        @media (max-width:768px) {
            .user-profile {
                flex-direction: row;
            }
        }

        #map_canvas {
            height: 300px;
        }

    </style>
    <section class="mt-4">
        <div class="d-flex row d-inline-block mb-5">
            <div class="col-lg-8 mx-auto" style=" min-height: 80vh ">
                <div class="col-lg-11 pl-lg-0">
                    @if (session('resent'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Pesan verifikasi sudah dikirimkan. Silakan lihat kotak masuk Anda.
                        </div>
                    @endif
                    <h2 class="title-color mb-2">Edit Profil</h2>
                    <div class="divider mb-4"></div>
                    {{-- <h6 class="mb-3">
                      <a href="/user/peta-menara">
                          <i class="icofont-simple-left"></i>
                          <i>Kembali ke halaman Peta</i>
                      </a>
                  </h6> --}}

                    <div class="detail">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="col-lg-12 shadow py-4 mb-3" style="border-radius: 7px;">
                            <div class="mx-3 mb-4 pb-2">
                                <form action="/user/update" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Email <span style="color: #e12454"><b> * </b></span></label>
                                        <input name="email" type="email"
                                            class="form-control input-sm @error('email') is-invalid @enderror"
                                            value='{{ old('email', $data->email) }}'>
                                        <span class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        {{-- <small>Jika terdapat perubahan pada email, Anda wajib melakukan verifikasi
                                            ulang.</small> --}}
                                    </div>
                                    <div class="form-group">
                                        <label>Nama <span style="color: #e12454"><b> * </b></span></label>
                                        <input name="name" type="text"
                                            class="form-control input-sm @error('name') is-invalid @enderror"
                                            value='{{ old('name', $data->name) }}'>
                                        <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Handphone <span style="color: #e12454"><b> * </b></span></label>
                                        <input name="phone" type="text"
                                            class="form-control input-sm @error('phone') is-invalid @enderror"
                                            value='{{ old('phone', $data->phone) }}'>
                                        <span class="text-danger">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Masukkan password Anda sebelum menyimpan perubahan!</b> 
                                          <span style="color: #e12454"><b> * </b></span>
                                        </label>
                                        <input name="password" type="password"
                                            class="form-control input-sm @error('password') is-invalid @enderror
                                            {{ session()->has('error') ? 'is-invalid' : '' }}">
                                        <span class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        <span class="text-danger">
                                            @if (session()->has('error'))
                                                {{ session('error') }}
                                            @endif
                                        </span>
                                    </div>
                                    <button class="btn btn-main btn-round-full" type="submit">Simpan</button>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

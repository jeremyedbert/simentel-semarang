@extends('layouts.main-user')
@section('content')
    <style>
      label{
        margin-top: 5px;
        margin-bottom: 0;
      }

      .form-control::placeholder{
          color: #9e9e9e;
          opacity: 1;
      }
      /* .text-danger{
        margin-top: 0;
      } */
    </style>
    <section class="mt-4">
        <div class="d-flex row h-100 d-inline-block">
            <div class="col-lg-6 d-flex justify-content-center">

                <div class="col-lg-8 shadow px-3 py-4 mb-5 mx-4 mt-3 bg-body" style="border-radius: 20px">
                    <h2 class="title-color mb-3 mx-3">Daftar Akun Pemohon</h2>
                    <form class="appoinment-form mx-3 mb-3" method="post" action="{{ route('user.create') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama<span style="color: #e12454"><b> * </b></span></label>
                            <input name="name" id="name" type="text" class="form-control" placeholder="contoh: John Doe" autofocus
                                value='{{ old('name') }}' autocomplete="off">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email<span style="color: #e12454"><b> * </b></span></label>
                            <input name="email" id="email" type="email" class="form-control" placeholder="contoh: johndoe@example.com"
                                value='{{ old('email') }}' autocomplete="off">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor HP<span style="color: #e12454"><b> * </b></span></label>
                            <input name="phone" id="phone" type="text" class="form-control" placeholder="contoh: 08123456789"
                                value='{{ old('phone') }}' autocomplete="off">
                            <span class="text-danger">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password<span style="color: #e12454"><b> * </b></span></label>
                            <input name="password" id="password" type="password" class="form-control" placeholder=""
                                autocomplete="off">
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Konfirmasi Password<span style="color: #e12454"><b> * </b></span></label>
                            <input name="cpassword" id="cpassword" type="password" class="form-control" placeholder=""
                                autocomplete="off">
                            <span class="text-danger">
                                @error('cpassword')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                            </div>
                        @endif
                        <button class="btn btn-main btn-round-full" type="submit">Daftar</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 img-login" style="height: 100%">
                <img src="/images/login.png" alt="" class="img-fluid mx-auto my-5 d-block" style="max-width: 54%">
            </div>
        </div>
    </section>

@endsection

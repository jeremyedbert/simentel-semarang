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
    <section>
        <div class="d-flex row h-100 d-inline-block">
            <div class="col-lg-6 d-flex justify-content-center">

                <div class="col-lg-8 shadow px-3 py-4 mb-5 mx-4 mt-3 bg-body" style="border-radius: 20px">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <h2 class="title-color mb-3 mx-3">Login sebagai Pemohon</h2>
                    <form class="appoinment-form mx-3 mb-3" method="post" action="{{ route('user.check') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email<span style="color: #e12454"><b> * </b></span></label>
                            <input name="email" id="email" type="email" class="form-control" placeholder="contoh: johndoe@example.com" autofocus
                                value='{{ old('email') }}' autocomplete="off">
                            <span class="text-danger">
                              @error('email')
                                {{ $message }}
                              @enderror
                            </span>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password<span style="color: #e12454"><b> * </b></span></label>
                            <input name="password" id="password" type="password" class="form-control" placeholder="" autocomplete="off">
                            <span class="text-danger">
                              @error('password')
                                  {{ $message }}
                              @enderror
                            </span>
                        </div>
                        
                        <div>
                            <p>Belum punya akun?
                                <a href="{{ route('user.register') }}"><b>Daftar akun pemohon</b></a>
                            </p>
                        </div>

                        {{-- <a class="btn btn-main btn-round" href="#">Submit</a> --}}
                        {{-- <div class="row">
                <button class="btn btn-main btn-round" type="submit">Submit</button>
                <div class="col">
                  <p>Belum punya akun?</p>
                  <p style="color: #e12454">Daftar sekarang!</p>
                </div>
              </div> --}}
                        @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                            </div>
                        @endif
                        <button class="btn btn-main btn-round-full" type="submit">Masuk</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 img-login" style="height: 100%">
                <img src="/images/login.png" alt="" class="img-fluid mx-auto my-5 d-block" style="max-width: 54%">
            </div>
        </div>
    </section>

@endsection

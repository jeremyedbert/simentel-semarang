@extends('layouts.main-user')
@section('content')

  <section>
    <div class="d-flex row h-100 d-inline-block">
      <div class="col-lg-6 d-flex justify-content-center">
        @if (session()->has('loginError'))
          <div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
              {{ session('loginError') }}
              {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
          </div>
        @endif
        <div class="col-lg-8 shadow px-3 py-4 mb-5 mx-4 mt-3 bg-body" style="border-radius: 20px">
          <h2 class="title-color mb-3 mx-3">Login sebagai Pemohon</h2>
          <form class="appoinment-form mx-3 mb-3" method="post" action="{{ route('login-user') }}">
                    @csrf
                        <div class="form-group">
                            <p>Email<span style="color: #e12454"><b> * </b></span></p>
                            <input name="email" id="email" type="email" class="form-control" placeholder="" autofocus
                                value={{ old('email') }}>
                        </div>
                        <div class="form-group">
                            <p>Password<span style="color: #e12454"><b> * </b></span></p>
                            <input name="password" id="password" type="password" class="form-control" placeholder="">
                        </div>

                        {{-- <a class="btn btn-main btn-round" href="#">Submit</a> --}}
                        {{-- <div class="row">
                <button class="btn btn-main btn-round" type="submit">Submit</button>
                <div class="col">
                  <p>Belum punya akun?</p>
                  <p style="color: #e12454">Daftar sekarang!</p>
                </div>
              </div> --}}
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
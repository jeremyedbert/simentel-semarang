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
          <h2 class="title-color mb-3 mx-3">Daftar sebagai Admin</h2>
          <form id="#" class="appoinment-form mx-3 mb-3" method="post" action="{{ route('') }}">
            <div class="form-group">
              <p>Email<span style="color: #e12454"><b> * </b></span></p>
              <input name="email" type="email" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <p>Password<span style="color: #e12454"><b> * </b></span></p>
              <input name="password" type="password" class="form-control" placeholder="">
            </div>
            
            <button class="btn btn-main btn-round-full" type="submit">Daftar</button>
          </form>
        </div>
      </div>
      <div class="col-lg-6 img-login" style="height: 100%">
        <img src="/images/login-2.png" alt="" class="img-fluid mx-auto my-5 d-block" style="max-width: 67%">
      </div>
    </div>
  </section>  
  
@endsection
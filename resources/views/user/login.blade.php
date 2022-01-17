@extends('layouts.main-user')
@section('content')

    <section>
        <div class="d-flex row">
            <div class="col-lg-5">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                    </div>
                @endif
                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
                        {{ session('loginError') }}
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                    </div>
                @endif
                <h2 class="title-color mb-4 ml-lg-4">Login sebagai Pemohon</h2>
                <form class="appoinment-form ml-lg-3" method="post" action="{{ route('login-user') }}">
                    @csrf
                    <div class="col">
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
                        <button class="btn btn-main btn-round" type="submit">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-7 img-login img-fluid">
                <img src="/images/tower-landing.jpg" alt="" class="img-fluid mx-auto d-block">
            </div>
        </div>
    </section>

@endsection

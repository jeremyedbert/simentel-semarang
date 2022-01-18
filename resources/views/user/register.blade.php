@extends('layouts.main-user')
@section('content')

    <section>
        <div class="d-flex row h-100 d-inline-block">
            <div class="col-lg-6 d-flex justify-content-center">

                <div class="col-lg-8 shadow px-3 py-4 mb-5 mx-4 mt-3 bg-body" style="border-radius: 20px">
                    <h2 class="title-color mb-3 mx-3">Daftar Akun Pemohon</h2>
                    <form class="appoinment-form mx-3 mb-3" method="post" action="{{ route('user.create') }}">
                        @csrf
                        <div class="form-group">
                            <p>Nama<span style="color: #e12454"><b> * </b></span></p>
                            <input name="name" id="name" type="text" class="form-control" placeholder="" autofocus
                                value={{ old('name') }}>
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <p>Email<span style="color: #e12454"><b> * </b></span></p>
                            <input name="email" id="email" type="email" class="form-control" placeholder=""
                                value={{ old('email') }}>
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <p>Nomor HP<span style="color: #e12454"><b> * </b></span></p>
                            <input name="phone" id="phone" type="text" class="form-control" placeholder=""
                                value={{ old('phone') }}>
                            <span class="text-danger">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <p>Password<span style="color: #e12454"><b> * </b></span></p>
                            <input name="password" id="password" type="password" class="form-control" placeholder="">
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <p>Konfirmasi Password<span style="color: #e12454"><b> * </b></span></p>
                            <input name="cpassword" id="cpassword" type="password" class="form-control" placeholder="">
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

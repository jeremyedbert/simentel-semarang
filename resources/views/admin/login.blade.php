@extends('layouts.main-user')
@section('content')
    <style>
        label {
            margin-top: 5px;
            margin-bottom: 0;
        }

        .form-control::placeholder {
            color: #9e9e9e;
            opacity: 1;
        }

    </style>
    <section>
        <div class="d-flex row h-100 d-inline-block">
            <div class="col-lg-6 d-flex justify-content-center">

                <div class="col-lg-8 shadow px-3 py-4 mb-5 mx-4 mt-3 bg-body" style="border-radius: 20px">
                    <h2 class="title-color mb-3 mx-3">Login sebagai Admin</h2>
                    <form id="#" class="appoinment-form mx-3 mb-3" method="post" action="{{ route('admin.check') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email<span style="color: #e12454"><b> * </b></span></label>
                            <input name="email" type="email" class="form-control" placeholder="contoh: johndoe@example.com"
                                value="{{ old('email') }}">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password<span style="color: #e12454"><b> * </b></span></label>
                            <input name="password" type="password" class="form-control" placeholder="">
                            <span class="text-danger">
                                @error('password')
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
                        <button class="btn btn-main btn-round-full" type="submit">Masuk</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 img-login" style="height: 100%">
                <img src="/images/login-2.png" alt="" class="img-fluid mx-auto my-5 d-block" style="max-width: 67%">
            </div>
        </div>
    </section>

@endsection

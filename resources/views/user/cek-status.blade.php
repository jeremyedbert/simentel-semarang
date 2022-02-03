@extends('layouts.main-user')
@section('content')

<style>
  .user-profile{
    background-color: #223a66;
    color: #fafafa;
  }
  .user-icon{
    font-size: 120pt;
  }

  .nama-user{
    color: #fafafa;
  }
  
</style>
<section>
    <div class="d-flex row h-100 d-inline-block">
        <div class="col-lg-4 d-flex justify-content-lg-end ml-0">

            <div class="col-lg-8 user-profile shadow px-3 py-4 mb-5 mx-4 bg-body" style="border-radius: 20px">
                <div class="material-icons-outlined user-icon d-flex justify-content-center mb-3" id="">account_circle</div>
              {{-- <i class="icofont-business-man-alt-1"></i> --}}
                <div class="col px-3">
                  <div class="d-flex justify-content-center">
                    <h3 class="nama-user">
                      {{ auth()->user()->name }}
                    </h3>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <span class="material-icons-outlined mr-2">
                      email
                    </span>
                    <span>
                      {{ auth()->user()->email }}
                    </span>
                  </div>
                  <div class="d-flex align-items-center mb-2">
                    <span class="material-icons-outlined mr-2">
                      phone_iphone
                    </span>
                    {{ auth()->user()->phone }}
                  </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mx-auto" style="height: 100%">
            <div class="col-lg-11 pl-lg-0">
              <h2 class="title-color mb-3">Status Permohonan</h2>
              {{-- <img src="/images/login.png" alt="" class="img-fluid mx-auto my-5 d-block" style="max-width: 54%"> --}}
            </div>
        </div>
    </div>
</section>
  
@endsection
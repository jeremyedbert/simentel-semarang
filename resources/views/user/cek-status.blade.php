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
    <div class="d-flex row d-inline-block mb-5">
        <div class="col-lg-4 d-flex justify-content-lg-end ml-0" style="height:min-content">

            <div class="col-lg-8 user-profile shadow px-3 py-4 mb-5 mx-4 bg-body" style="border-radius: 20px">
                <div class="material-icons-outlined user-icon d-flex justify-content-center mb-3" id="">account_circle</div>
              {{-- <i class="icofont-business-man-alt-1"></i> --}}
                <div class="col px-auto">
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
        <div class="col-lg-8 mx-auto" style=" min-height: 80vh ">
            <div class="col-lg-11 pl-lg-0">
              <h2 class="title-color mb-2">Status Permohonan</h2>
              <div class="divider mb-4"></div>
              <div class="permohonan">
                <div class="col-lg-12 shadow py-4 mb-3" style="border-radius: 7px; border-left: #e12454 solid 7px">
                  <div class="col">
                    <div class="mb-2 d-flex justify-content-between" style="border-bottom: #bac6d1 solid 2px">
                      <div class="row">
                        <div class="ml-3"><b>INDOSAT-360</b></div>
                        <div class="ml-3">3 Feb 2022</div>
                      </div>
                      <h5>
                        <span class="badge bg-warning text-dark" style="opacity: 0.75">Sedang ditinjau</span>
                        {{-- <span class="badge bg-success" style="opacity: 0.75; color: white">Disetujui</span>
                        <span class="badge bg-danger" style="opacity: 0.75; color: white">Ditolak</span> --}}
                      </h5>
                    </div>
                    <h3>PT Indo Satelite</h3>
                    <div class="mb-2 d-flex row justify-content-between">
                      <div class="col-lg-6">
                        <i class="icofont-location-pin"></i>
                        <span>Pandansari,&nbsp;</span>
                        <span>Semarang Tengah</span>
                      </div>
                      <a href="#" class="mx-3">
                        <b><i>Detail</i></b>
                        <i class="icofont-simple-right "></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="permohonan">
                <div class="col-lg-12 shadow py-4 mb-3" style="border-radius: 7px; border-left: #e12454 solid 7px">
                  <div class="col">
                    <div class="mb-2 d-flex justify-content-between" style="border-bottom: #bac6d1 solid 2px">
                      <div class="row">
                        <div class="ml-3"><b>INDOSAT-360</b></div>
                        <div class="ml-3">3 Feb 2022</div>
                      </div>
                      <h5>
                        <span class="badge bg-warning text-dark" style="opacity: 0.75">Sedang ditinjau</span>
                        {{-- <span class="badge bg-success" style="opacity: 0.75; color: white">Disetujui</span>
                        <span class="badge bg-danger" style="opacity: 0.75; color: white">Ditolak</span> --}}
                      </h5>
                    </div>
                    <h3>PT Indo Satelite</h3>
                    <div class="mb-2 d-flex row justify-content-between">
                      <div class="col-lg-6">
                        <i class="icofont-location-pin"></i>
                        <span>Pandansari,&nbsp;</span>
                        <span>Semarang Tengah</span>
                      </div>
                      <a href="#" class="mx-3">
                        <b><i>Detail</i></b>
                        <i class="icofont-simple-right "></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>
  
@endsection
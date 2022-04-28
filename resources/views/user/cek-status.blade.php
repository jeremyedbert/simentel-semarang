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
  
  @media (max-width:576px){
    .id-tgl{
      flex-direction: column;
    }
  }
</style>
<section class="mt-4">
    <div class="d-flex row d-inline-block mb-5">
        <div class="col-lg-4 d-flex justify-content-lg-end ml-0" style="height:min-content">

            <div class="col-lg-8 user-profile shadow px-3 py-4 mb-5 mx-4 bg-body" style="border-radius: 16px">
                <div class="material-icons-outlined user-icon d-flex justify-content-center mb-3" id="">account_circle</div>
              {{-- <i class="icofont-business-man-alt-1"></i> --}}
                <div class="col px-auto">
                  <div class="d-flex justify-content-center">
                    <h3 class="nama-user text-center">
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
              @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {!! session('success') !!}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif
              @foreach ($data as $d)
                <div class="permohonan">
                  <div class="col-lg-12 shadow py-4 mb-3" 
                    @if ( $d->status->id === 1) style="border-radius: 7px; border-left: rgba(255, 193, 7, 0.7) solid 7px"
                    @elseif ( $d->status->id === 2) style="border-radius: 7px; border-left: rgba(40, 167, 69, 0.7) solid 7px"
                    @else style="border-radius: 7px; border-left: rgba(220, 53, 69, 0.7) solid 7px"
                    @endif
                  >
                    <div class="col">
                      <div class="mb-2 d-flex justify-content-between" style="border-bottom: #bac6d1 solid 2px">
                        <div class="row id-tgl">
                          <div class="ml-3"><b>{{ $d->tower->idMenara }}</b></div>
                          <div class="ml-3">{{ ltrim($d->created_at->translatedFormat('d F Y'), '0')}}</div>
                        </div>
                        <h5>
                          @if ( $d->status->id === 1)
                            <span class="badge bg-warning text-dark" style="opacity: 0.7">{{ $d->status->name}}</span>
                          @elseif ( $d->status->id === 2)
                            <span class="badge bg-success" style="opacity: 0.7; color: white">{{ $d->status->name}}</span>
                          @else
                            <span class="badge bg-danger" style="opacity: 0.7; color: white">{{ $d->status->name}}</span>
                          @endif 
                        </h5>
                      </div>
                      <h3 class="title-color">{{ $d->tower->pemilik }}</h3>
                      <div class="mb-2 d-flex row justify-content-between">
                        <div class="col-lg-6">
                          <i class="icofont-location-pin"></i>
                          <span>{{ $d->tower->kelurahan->name }},&nbsp;</span>
                          <span>{{ $d->tower->kecamatan->name }}</span>
                        </div>
                        <a href="/user/cekstatus/{{ $d->id }}" class="mx-3">
                          <b><i>Detail</i></b>
                          <i class="icofont-simple-right "></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
        </div>
    </div>
</section>
  
@endsection
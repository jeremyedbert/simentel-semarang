@extends('layouts.main-admin')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Edit Zona</h4>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div id="map_canvas" style="width: auto; height: 30rem"></div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="row d-flex justify-content-between">
                                    {{-- <div class="col-md-6">
                            <div class="card-title"><b><i>No. Tiket: {{ $data->id }}</i></b></div>
                            <div class="card-title"><i>{{ $data->tower->idMenara }}</i></div>
                        </div>
                        <div class="d-flex">
                            <div class="col text-md-right">
                                <p class="mb-0 mt-3 mt-md-0"><b>Anda dapat menghubungi pendaftar:</b></p>
                                <p class="mb-0">{{ $data->user->name }}</p>
                                <p class="mb-0">{{ $data->user->phone }}</p>
                                <p class="mb-0">{{ $data->user->email }}</p>
                            </div>
                        </div> --}}
                                </div>
                            </div>
                            {{-- Form Edit --}}
                            <form action="/admin/zona" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-default"
                                                @error('name') style="border: 1px solid rgb(255, 0, 0)" @enderror>
                                                <label for="name">Nama <span class="required-label">*</span></label>
                                                <input type="text" class="form-control"
                                                    value="{{ old('name') }}" id="name" name="name">
                                                <span class="text-danger">
                                                    @error('name')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tinggi">Tinggi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            value="{{ $data->tower->tinggi }}" id="tinggi" name="tinggi"
                                            readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">meter</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="luas">Luas</label>
                                    <input type="text" class="form-control"
                                        value="{{ $data->tower->luas }}" id="luas" name="luas" readonly>
                                </div>
                            </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default"
                                                @error('radius') style="border: 1px solid rgb(255, 0, 0)" @enderror>
                                                <label for="radius">Radius</label>
                                                <input type="text" class="form-control"
                                                    value="{{ old('radius') }}" id="radius" name="radius">
                                                <span class="text-danger">
                                                    @error('radius')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group form-group-default"
                                                @error('kecamatan_id') style="border: 1px solid rgb(255, 0, 0)" @enderror>
                                                <label for="longitude">Kecamatan</label>
                                                <select class="form-control" name="kecamatan_id" id="kecamatan_id">
                                                    @foreach ($kecamatan as $key => $kec)
                                                        <option value="{{ $key }}"
                                                            {{ old('kecamatan_id') == $key ? 'selected' : '' }}>
                                                            {{ $kec }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">
                                                    @error('kecamatan_id')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default"
                                                @error('latitude') style="border: 1px solid rgb(255, 0, 0)" @enderror>
                                                <label for="latitude">Latitude</label>
                                                <input type="text" class="form-control"
                                                    value="{{ old('latitude') }}" id="lat"
                                                    name="latitude">
                                                <span class="text-danger">
                                                    @error('latitude')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default"
                                                @error('longitude') style="border: 1px solid rgb(255, 0, 0)" @enderror>
                                                <label for="longitude">Longitude</label>
                                                <input type="text" class="form-control"
                                                    value="{{ old('longitude') }}" id="lng"
                                                    name="longitude">
                                                <span class="text-danger">
                                                    @error('longitude')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-action">
                                    <button class="btn btn-success" type="submit">
                                        <span class="btn-label">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        Simpan</button>
                                    {{-- <button class="btn btn-danger">Cancel</button> --}}
                                    <a class="btn btn-danger" href="/admin/zona">
                                        <span class="btn-label">
                                            <i class="fas fa-times"></i>
                                        </span>
                                        Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

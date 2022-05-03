{{-- Ini adalah halaman view export Excel --}}
@extends('layouts.main-admin')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h1 style="color: black" class="pb-3"><b>Cetak Rekap</b></h1>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Data dicetak dalam bentuk file Excel (.xlsx). Sebelum Anda mengexport data, silakan filter
                                data yang Anda inginkan.
                            </div>
                            <form id="#" method="get" action="/admin/cetak/exportTower" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div>
                                        <h5 class="card-title">Pilih tanggal disetujui</h5>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Dari tanggal</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="datepicker"
                                                            name="datepicker">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 justify-content-center d-flex align-items-center">
                                                <div>
                                                    <i class="fas fa-long-arrow-alt-right fa-4x"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Sampai tanggal</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="datepicker2"
                                                            name="datepicker2">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h5 class="card-title">Pilih kecamatan</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    @foreach ($kecamatan as $k)
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                name="daftar[]" id="customCheck{{ $k->id }}"
                                                                value="{{ $k->id }}" 
                                                                {{ (is_array(old('daftar')) && in_array($k->id, old('daftar'))) ? 'checked' : '' }}>
                                                            <label class="custom-control-label"
                                                                for="customCheck{{ $k->id }}">{{ $k->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <span class="text-danger">
                                                    @error('daftar')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h5 class="card-title">Pilih tipe menara</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group @error('tipeMenara') has-error @enderror">
                                                    <select class="form-control input-square" id="squareSelect" name="tipeMenara">
                                                        <option value=""> -- Pilih tipe menara -- </option>
                                                        <option value="0">Semua tipe</option>
                                                        @foreach ($tipeMenara as $t)
                                                            <option value="{{ $t->id }}" 
                                                                {{ old('tipeMenara') == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span class="text-danger">
                                                    @error('tipeMenara')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-action">
                                    <button class="btn btn-link" type="submit">
                                        <span class="btn-label">
                                            <i class="fas fa-file-download"></i>
                                        </span>
                                        Download
                                    </button>
                                    <a href="/admin/cetak/exportTower" class="btn btn-link">Test</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
        rel="stylesheet" />
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker({
                format: 'dd/mm/yyyy',
            });

            $('#datepicker2').datepicker({
                format: 'dd/mm/yyyy',
            });
        })
    </script>
@endsection

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
                                                <div class="form-group @error('datepicker') has-error @enderror">
                                                    <label>Dari tanggal (format: mm/dd/yyyy)</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="datepicker"
                                                            name="datepicker" autocomplete="off"
                                                            value='{{ old('datepicker') }}'>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="text-danger">
                                                    @error('datepicker')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                            <div class="col-md-2 justify-content-center d-flex align-items-center">
                                                <div>
                                                    <i class="fas fa-long-arrow-alt-right fa-4x"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group @error('datepicker2') has-error @enderror">
                                                    <label>Sampai tanggal (format: mm/dd/yyyy)</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="datepicker2"
                                                            name="datepicker2" autocomplete="off"
                                                            value='{{ old('datepicker2') }}'>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="text-danger">
                                                    @error('datepicker2')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h5 class="card-title">Pilih kecamatan</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-check d-flex">
                                                    <div class="col-md-4">
                                                        @for ($i = 0; $i < 8; $i++)
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="daftar[]" id="customCheck{{ $i + 1 }}"
                                                                    value="{{ $i + 1 }}"
                                                                    {{ is_array(old('daftar')) && in_array($i + 1, old('daftar')) ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="customCheck{{ $i + 1 }}">{{ $kecamatan[$i]->name }}</label>
                                                            </div><br>
                                                        @endfor
                                                    </div>
                                                    <div class="col-md-4">
                                                        @for ($i = 8; $i < 16; $i++)
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="daftar[]" id="customCheck{{ $i + 1 }}"
                                                                    value="{{ $i + 1 }}"
                                                                    {{ is_array(old('daftar')) && in_array($i + 1, old('daftar')) ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="customCheck{{ $i + 1 }}">{{ $kecamatan[$i]->name }}</label>
                                                            </div><br>
                                                        @endfor
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="allChecked" onchange="semuaKecamatan(this)">
                                                            <label class="custom-control-label" for="allChecked">Semua
                                                                kecamatan</label>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        function semuaKecamatan(source) {
                                                            let daftar = document.getElementsByName('daftar[]');
                                                            let n = daftar.length;
                                                            for (let i = 0; i < n; i++) {
                                                                daftar[i].checked = source.checked;
                                                            }
                                                        }
                                                    </script>
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
                                                    <select class="form-control input-square" id="squareSelect"
                                                        name="tipeMenara">
                                                        <option value=""> -- Pilih tipe menara -- </option>
                                                        <option value="5" {{ old('tipeMenara') == 5 ? 'selected' : '' }}>
                                                            Semua tipe</option>
                                                        @foreach ($tipeMenara as $t)
                                                            <option value="{{ $t->id }}"
                                                                {{ old('tipeMenara') == $t->id ? 'selected' : '' }}>
                                                                {{ $t->name }}</option>
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
                format: 'mm/dd/yyyy',
            });

            $('#datepicker2').datepicker({
                format: 'mm/dd/yyyy',
            });
        })
    </script>
@endsection

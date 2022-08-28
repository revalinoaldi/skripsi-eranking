@extends('layouts.main')

@section('container')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="/assets/css/datatables.css">
<!-- Plugins css Ends-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Form Input Data Siswa</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/siswa">Siswa</a></li>
                    <li class="breadcrumb-item active">Form Data Siswa</li>
                </ol>
            </div>
            <div class="col-lg-6">
                &nbsp;
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">


        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            @if($errors->any())
            <div class="alert alert-danger">
                <p><strong>Opps Something went wrong</strong></p>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Form Siswa</h5>
                </div>
                <form class="form theme-form" action="/admin/siswa{{ @$data['siswa']->nis ? "/{$data['siswa']->nis}" : "" }}" method="POST">

                    @csrf

                    @if (@$data['siswa']->nis)
                    @method('put')
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="nis">NIS</label>
                                    <input class="form-control" value="{{ old('nis', @$data['siswa']->nis) }}" {{ @$data['siswa']->nis ? "readonly" : "" }} id="nis" name="nis" type="text" placeholder="Enter NIS" />
                                    @error('nis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_siswa">Nama Lengkap</label>
                                    <input class="form-control" value="{{ old('nama_siswa', @$data['siswa']->nama_siswa) }}" id="nama_siswa" name="nama_siswa" type="text" placeholder="Enter Nama Lengkap Siswa" />
                                    @error('nama_siswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="no_telp">No Telp</label>
                                    <input class="form-control" value="{{ old('no_telp', @$data['siswa']->no_telp) }}" id="no_telp" name="no_telp" type="number" placeholder="Enter No Telephone Siswa" />
                                    @error('no_telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <textarea class="form-control"  id="alamat" name="alamat" placeholder="Enter Alamat Tinggal Lengkap">{{ old('alamat', @$data['siswa']->alamat) }}</textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="tahun_masuk">Tahun Masuk</label>
                                    @php
                                    $years = [];
                                    for($i = date('Y'); $i >= date('Y', strtotime('-5 year')); $i--){
                                        $years[] = $i;
                                    }
                                    @endphp
                                    <select class="form-select " id="tahun_masuk" name="tahun_masuk">
                                        @foreach ($years as $y => $year)
                                        <option

                                        {{ old('tahun_masuk', @$data['siswa']->tahun_masuk) == $year ? 'selected=""' : ($year == date('Y') ? "selected=''" : "") }}
                                        value="{{ $year }}">
                                        {{ $year }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('nis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                @php
                                $genders = ['Laki-Laki','Perempuan'];
                                @endphp
                                <select class="form-select digits" id="jenis_kelamin" name="jenis_kelamin">
                                    @foreach ($genders as $key => $gender)

                                    <option
                                    {{ old('jenis_kelamin', @$data['siswa']->jenis_kelamin) == $gender ? 'selected=""' : '' }}
                                    value="{{ $gender }}">
                                    {{ $gender }}
                                </option>
                                @endforeach
                            </select>
                            @error('nis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label" for="kelas_id">Kelas</label>
                            <select class="form-select digits" id="kelas_id" name="kelas_id">
                                @foreach ($data['kelas'] as $kelas)

                                <option
                                {{ old('kelas_id', @$data['siswa']->kelas_id) == $kelas->id ? 'selected=""' : '' }}
                                value="{{ $kelas->id }}">
                                {{ $kelas->nama_kelas }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer text-end">
            <button class="btn btn-primary" type="submit">Save Record</button>
            <input class="btn btn-light" type="reset" value="Cancel" />
        </div>
    </form>
</div>
</div>
<!-- Zero Configuration  Ends-->
</div>
</div>
<!-- Container-fluid Ends-->
<!-- Plugins JS start-->
<script src="../assets/js/form-validation-custom.js"></script>

<!-- Theme js-->
<script src="/assets/js/script.js"></script>
<script src="/assets/js/theme-customizer/customizer.js"></script>
<!-- Plugins JS Ends-->
@endsection

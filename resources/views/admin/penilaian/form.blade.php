@extends('layouts.main')

@section('container')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="/assets/css/datatables.css">
<!-- Plugins css Ends-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Form Input Kelas Semester</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/penilaian/kelas">Kelas Semester</a></li>
                    <li class="breadcrumb-item active">Form Kelas Semester</li>
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
            @if (session('notif'))
            {!! session('notif') !!}
            @endif
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
                    <h5>Form Kelas Semester</h5>
                </div>
                <form class="form theme-form" action="/admin/penilaian/kelas{{ @$data['penilaian']->kode_penilaian ? "/{$data['penilaian']->kode_penilaian}" : "" }}" method="POST">

                    @csrf

                    @if (@$data['penilaian']->kode_penilaian)
                    @method('put')
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="kode_penilaian">Kode Penilaian</label>
                                    <input class="form-control" value="{{ old('kode_penilaian', @$data['penilaian']->kode_penilaian) }}" {{ @$data['penilaian']->kode_penilaian ? "readonly" : "" }} id="kode_penilaian" name="kode_penilaian" type="text" placeholder="Enter Kode Penilaian" />
                                    @error('kode_penilaian')
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
                                    <label class="form-label" for="kelas">kelas</label>
                                    <select class="form-select digits" id="kelas_id" name="kelas_id">
                                        @foreach ($data['kelas'] as $kelas)
                                        <option {{ old('kelas_id', @$data['penilaian']->kelas_id) == $kelas->id ? 'selected=""' : '' }} value="{{ $kelas->id }}">
                                            {{ $kelas->nama_kelas }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="tahun_ajar">Tahun Ajaran</label>
                                    <select class="form-select digits" id="tahun_ajar_id" name="tahun_ajar_id">
                                        @foreach ($data['tahun_ajar'] as $tahun)
                                        <option {{ old('tahun_ajar_id', @$data['penilaian']->tahun_ajar_id) == $tahun->id ? 'selected=""' : '' }} value="{{ $tahun->id }}">
                                            {{ $tahun->tahun_ajar }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="user">Wali Kelas</label>
                                    <select class="form-select digits" id="user_id" name="user_id">
                                        @foreach ($data['user'] as $user)
                                        <option {{ old('user_id', @$data['penilaian']->user_id) == $user->id ? 'selected=""' : '' }} value="{{ $user->id }}">
                                            {{ $user->nama_user }}
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

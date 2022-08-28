@extends('layouts.main')

@section('container')
@php
$level = 'admin';
if(auth()->user()->level->slug == 'guru'){
    $level = 'guru';
}
@endphp
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="/assets/css/datatables.css">
<!-- Plugins css Ends-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Data Siswa</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/siswa">Siswa</a></li>
                    <li class="breadcrumb-item active">Data Siswa</li>
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

            <div class="card">
                <div class="card-header">
                    <div class="row" style="border-bottom: 1px solid rgb(222, 222, 222); padding-bottom: 10px;">
                        <div class="col-md-6">
                            <h5>Data Siswa</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            @admin
                            <a href="/admin/siswa/create" class="btn btn-primary-light btn-sm">
                                <i class="fa fa-user-plus"></i> &nbsp;Add More
                            </a>

                            {{-- <a href="/admin/export/excel?modul=siswa{{ @request('kelas') ? "&kelas=".request('kelas') : "" }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-file-excel-o"></i> &nbsp;Export Excel
                            </a> --}}

                            <a href="/admin/export/pdf?modul=siswa{{ @request('kelas') ? "&kelas=".request('kelas') : "" }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> &nbsp;Export PDF
                            </a>
                            @endadmin
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-7 text-end">
                                        <select class="form-select" id="validationDefault04" name="kelas" required="">
                                            <option selected="" disabled="" value="">Choose...</option>
                                            @foreach ($data['kelas'] as $kelas)
                                            <option {{ request('kelas') == $kelas['slug'] ? "selected=''" : "" }} value="{{ $kelas['slug'] }}">{{ $kelas['nama_kelas'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary" style="width: 100%" type="submit"> <i class="fa  fa-eye"></i> Filter by Kelas</button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="/admin/siswa" class="btn btn-danger" style="width: 100%" type="submit"> <i class="fa fa-trash"></i> Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="display" id="basic-3">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>No Telp</th>
                                    <th>Tahun Masuk</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kelas</th>
                                    @admin
                                    <th>Action</th>
                                    @endadmin
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['siswa'] as $siswa)

                                <tr>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->nama_siswa }} </td>
                                    <td>{{ $siswa->no_telp }}</td>
                                    <td>{{ $siswa->tahun_masuk }}</td>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                    <td>{{ $siswa->kelas->nama_kelas }}</td>
                                    @admin
                                    <td>
                                        <a href="/admin/siswa/{{ $siswa->nis }}/edit" class="btn btn-sm btn-primary border-0"><i class="fa fa-pencil"></i></a>
                                        <form action="/admin/siswa/{{ $siswa->nis }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger border-0">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    @endadmin
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->

    </div>
</div>
<!-- Container-fluid Ends-->
<!-- Plugins JS start-->

<!-- Plugins JS start-->
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/datatable/datatables/datatable.custom.js"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="/assets/js/script.js"></script>
<script src="/assets/js/theme-customizer/customizer.js"></script>
<!-- Plugins JS Ends-->
@endsection

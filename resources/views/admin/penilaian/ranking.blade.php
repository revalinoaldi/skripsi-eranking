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
                <h3>Data Ranking Siswa</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/{{$level}}/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/{{$level}}/siswa">Siswa</a></li>
                    <li class="breadcrumb-item active">Data Ranking Siswa</li>
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
                            <h5>Data Ranking Siswa</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="/{{$level}}/export/pdf?modul=siswa-berprestasi{{ @request('kelas') ? "&kelas=".request('kelas') : "" }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-file-pdf-o"></i> &nbsp;Export PDF
                            </a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <form action="/{{$level}}/penilaian/siswa">
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
                                        <a href="/{{$level}}/penilaian/siswa" class="btn btn-danger" style="width: 100%" type="submit"> <i class="fa fa-trash"></i> Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="display" id="basic-21">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Ranking</th>
                                    <th>Rata Rata</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['siswa'] as $siswa)

                                <tr>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->nama_siswa }} </td>
                                    <td>{{ $siswa->nama_kelas }}</td>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ @$siswa->total_rata_rata }}</td>
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

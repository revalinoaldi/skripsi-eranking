@extends('layouts.main')

@section('container')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="/assets/css/datatables.css">
<!-- Plugins css Ends-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Penilaian Kelas Semester</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/penilaian/kelas">Kelas Semester</a></li>
                    <li class="breadcrumb-item active">Form Penilaian Siswa Perkelas</li>
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
                    <h5>Form Penilaian Siswa Kelas {{ $data['penilaian']->kelas->nama_kelas }}</h5>
                </div>
                <form class="form theme-form" action="/admin/penilaian/kelas/nilai-siswa/{{ $data['penilaian']->kode_penilaian }}" method="POST">

                    @csrf

                    <input type="hidden" name="kode" value="{{ $data['penilaian']->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            @foreach ($data['kriteria'] as $item)
                                                <th>{{ $item->keterangan." ({$item->kode})" }}</th>
                                            @endforeach

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($data['siswa'] as $siswa)

                                        <tr>
                                            <td>
                                                {{ $siswa->nis }}
                                                <input type="hidden" name="item[{{ $i }}][siswa_id]" value="{{ $siswa->id }}">
                                            </td>
                                            <td>{{ $siswa->nama_siswa }} </td>

                                            @foreach ($data['kriteria'] as $item)
                                                <td>
                                                    <input type="hidden" name="item[{{ $i }}][kriteria][{{ $item->id }}][id]" value="{{ $item->id }}">
                                                    <input type="hidden" name="item[{{ $i }}][kriteria][{{ $item->id }}][jenis]" value="{{ $item->jenis->slug }}">
                                                    <input type="number" name="item[{{ $i }}][kriteria][{{ $item->id }}][skor]" class="form-controll" placeholder="Enter value">
                                                </td>
                                            @endforeach
                                        </tr>
                                        @php
                                            $i++
                                        @endphp
                                        @endforeach

                                    </tbody>
                                </table>
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
<!-- Plugins JS start-->
<script src="/assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/js/datatable/datatables/datatable.custom.js"></script>
<!-- Plugins JS Ends-->

<!-- Theme js-->
<script src="/assets/js/script.js"></script>
<script src="/assets/js/theme-customizer/customizer.js"></script>
<!-- Plugins JS Ends-->
@endsection

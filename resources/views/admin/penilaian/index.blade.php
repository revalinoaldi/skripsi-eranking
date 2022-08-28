@extends('layouts.main')

@section('container')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="/assets/css/datatables.css">
<!-- Plugins css Ends-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Data Kelas Semester</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/penilaian/kelas">Penilaian</a></li>
                    <li class="breadcrumb-item active">Data Kelas Semester</li>
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
                            <h5>Data Kelas Semester</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            @admin
                            <a href="/admin/penilaian/kelas/create" class="btn btn-primary-light" type="submit">
                                <i class="fa fa-user-plus"></i> &nbsp;Add More
                            </a>
                            @endadmin
                        </div>
                    </div>
                    {{-- <div class="row mt-4">
                        <div class="col-md-12">
                            <form>
                                <div class="row">
                                    <div class="col-md-7 text-end">
                                        <select class="form-select" id="level" name="level" required="">
                                            <option selected="" disabled="" value="">Choose...</option>
                                            @foreach ($data['level'] as $level)
                                            <option {{ request('level') == $level['slug'] ? "selected=''" : "" }} value="{{ $level['slug'] }}">{{ $level['level'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary" style="width: 100%" type="submit"> <i class="fa  fa-eye"></i> Filter by Kelas</button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="/admin/user" class="btn btn-danger" style="width: 100%" type="submit"> <i class="fa fa-trash"></i> Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Kelas</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Nama Guru</th>
                                    <th>No Telp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['penilaian'] as $detail)
                                <tr>
                                    <td>{{ $detail->kode_penilaian }} </td>
                                    <td>{{ $detail->kelas->nama_kelas }}</td>
                                    <td>{{ $detail->tahun_ajar->tahun_ajar }}</td>
                                    <td>{{ $detail->user->nama_user }}</td>
                                    <td>{{ $detail->user->no_telp }}</td>

                                    <td>
                                        @if ($detail->detail_penilaian_semester->count() == 0)
                                            <a href="/admin/penilaian/kelas/{{ $detail->kode_penilaian }}" class="btn btn-sm btn-success border-0"><i class="fa fa-info"></i></a>
                                        @endif

                                        @admin
                                        <a href="/admin/penilaian/kelas/{{ $detail->kode_penilaian }}/edit" class="btn btn-sm btn-primary border-0"><i class="fa fa-pencil"></i></a>
                                        <form action="/admin/penilaian/kelas/{{ $detail->kode_penilaian }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger border-0">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        @endadmin
                                    </td>

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

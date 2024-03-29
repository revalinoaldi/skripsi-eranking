@extends('layouts.main')

@section('container')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="/assets/css/datatables.css">
<!-- Plugins css Ends-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Data Bobot Penilaian</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Aspek Bobot Penilaian</a></li>
                    <li class="breadcrumb-item active">Bobot Penilaian</li>
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
                            <h5>Data Bobot Penilaian</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="/admin/kriteria/bobot/create" class="btn btn-primary-light" type="submit">
                                <i class="fa fa-plus"></i> &nbsp;Add More
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Minimal Nilai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['bobot'] as $bobot)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bobot->keterangan }} </td>
                                    <td>{{ $bobot->min_nilai }}</td>
                                    <td>
                                        <a href="/admin/kriteria/bobot/{{ $bobot->slug }}/edit" class="btn btn-sm btn-primary border-0"><i class="fa fa-pencil"></i></a>
                                        <form action="/admin/kriteria/bobot/{{ $bobot->slug }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger border-0">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
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

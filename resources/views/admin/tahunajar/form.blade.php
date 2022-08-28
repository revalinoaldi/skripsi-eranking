@extends('layouts.main')

@section('container')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="/assets/css/datatables.css">
<!-- Plugins css Ends-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Form Tahun Ajaran</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Form Tahun Ajar</li>
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
                    <h5>Form Tahun Ajaran</h5>
                </div>
                <form class="form theme-form" action="/admin/tahun-ajar{{ @$data['tahunajar']->slug ? "/{$data['tahunajar']->slug}" : "" }}" method="POST">

                    @csrf

                    @if (@$data['tahunajar']->slug)
                    @method('put')
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="tahun_ajar">Tahun Ajaran <span class="text-danger">*</span></label>
                                    <input class="form-control" value="{{ old('tahun_ajar', @$data['tahunajar']->tahun_ajar) }}" id="tahun_ajar" name="tahun_ajar" type="text" placeholder="Enter Tahun Ajaran" />
                                    <small class="text-muted mt-3">Example : (2019 2020)</small>
                                    @error('tahun_ajar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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

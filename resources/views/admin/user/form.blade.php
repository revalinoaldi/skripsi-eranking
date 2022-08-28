@extends('layouts.main')

@section('container')
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="/assets/css/datatables.css">
<!-- Plugins css Ends-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h3>Form Input Data User</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/user">User Pengguna</a></li>
                    <li class="breadcrumb-item active">Form Data User</li>
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
                    <h5>Form User</h5>
                </div>
                <form class="form theme-form" action="/admin/user{{ @$data['user']->username ? "/{$data['user']->username}" : "" }}" method="POST">

                    @csrf

                    @if (@$data['user']->username)
                    @method('put')
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_user">Nama Lengkap</label>
                                    <input class="form-control" value="{{ old('nama_user', @$data['user']->nama_user) }}" id="nama_user" name="nama_user" type="text" placeholder="Enter Nama Lengkap" />
                                    @error('nama_user')
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
                                    <label class="form-label" for="username">Username</label>
                                    <input class="form-control" value="{{ old('username', @$data['user']->username) }}"  id="username" name="username" type="text" placeholder="Enter Username" />
                                    @error('username')
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
                                    <label class="form-label" for="email">Email</label>
                                    <input class="form-control" value="{{ old('email', @$data['user']->email) }}" id="email" name="email" type="email" placeholder="Enter Email" />
                                    @error('email')
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
                                    <input class="form-control" value="{{ old('no_telp', @$data['user']->no_telp) }}" id="no_telp" name="no_telp" type="number" placeholder="Enter No Telephone Siswa" />
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
                                    <label class="form-label" for="password">Password</label>
                                    <input class="form-control"  id="password" name="password" type="password" placeholder="Enter Password" />
                                    @error('password')
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
                                    <textarea class="form-control"  id="alamat" name="alamat" placeholder="Enter Alamat Tinggal Lengkap">{{ old('alamat', @$data['user']->alamat) }}</textarea>
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
                                <label class="form-label" for="level">Level</label>
                                <select class="form-select digits" id="level_id" name="level_id">
                                    @foreach ($data['level'] as $level)
                                    <option
                                    {{ old('level', @$data['user']->level_id) == $level->id ? 'selected=""' : '' }}
                                    value="{{ $level->id }}">
                                    {{ $level->level }}
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

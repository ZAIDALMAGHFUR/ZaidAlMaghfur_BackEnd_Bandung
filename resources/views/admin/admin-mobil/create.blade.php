@extends('layouts.app')
@section('content')

    @pushOnce('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    @endPushOnce


    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Create Mobile</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
                            <li class="breadcrumb-item">Data MMaster</li>
                            <li class="breadcrumb-item active">Create Mobile</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <!-- Bookmark Start-->
                        <div class="bookmark">
                            <ul>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Tables"><i
                                            data-feather="inbox"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Chat"><i
                                            data-feather="message-square"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Icons"><i
                                            data-feather="command"></i></a></li>
                                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover"
                                        data-placement="top" title="" data-original-title="Learning"><i
                                            data-feather="layers"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                                    <form class="form-inline search-form">
                                        <div class="form-group form-control-search">
                                            <input type="text" placeholder="Search..">
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- Bookmark Ends-->
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="col-lg-12">
                                <div class="card p-3">
                                    <form method="post" class="needs-validation" novalidate=""
                                        action="{{ route('admin/mobile.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label for="nama_mobil" class="form-label">Name Mobil</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="nama_mobil"
                                                        value="{{ old('nama_mobil') }}" id="nama_mobil" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="merk_mobil" class="form-label">Merek Mobile</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="merk_mobil"
                                                        value="{{ old('merk_mobil') }}" id="merk_mobil" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label for="plat_nomor" class="form-label">Plat Nomor</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="plat_nomor"
                                                        value="{{ old('plat_nomor') }}" id="plat_nomor" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="warna_mobil" class="form-label">Warna Mobile</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="warna_mobil"
                                                        value="{{ old('warna_mobil') }}" id="warna_mobil" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label for="tahun_keluaran" class="form-label">Tahun Keluaran</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="tahun_keluaran"
                                                        value="{{ old('tahun_keluaran') }}" id="tahun_keluaran" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="harga_sewa" class="form-label">Harga Sewa Mobile</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" name="harga_sewa"
                                                        value="{{ old('harga_sewa') }}" id="harga_sewa" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label for="gambar_mobils" class="form-label">Gambar Mobil</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" name="gambar_mobils"
                                                        value="{{ old('gambar_mobils') }}" id="gambar_mobils" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="status_mobil" class="form-label">Status Mobil</label>
                                                <div class="col-sm-10">
                                                    <select class="js-example-basic-single col-sm-12" name="status_mobil"
                                                        id="status_mobil">
                                                        <option value="">-- Select Mobil --</option>
                                                        <option value="Tersedia">Tersedia</option>
                                                        <option value="Di Sewa">Di Sewa</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @pushOnce('js')
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    @endPushOnce
@endsection

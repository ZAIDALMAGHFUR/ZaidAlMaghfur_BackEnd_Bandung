@extends('layouts.tes')
@section('content')
    @pushOnce('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    @endPushOnce

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Daftar Agent</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
                            <li class="breadcrumb-item">Data Master</li>
                            <li class="breadcrumb-item active">Daftar Agent</li>
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
        <div class=" d-flex justify-content-center">
            <div class="container-fluid">
                <div class="col-sm-12 col-xl-6">
                    <div class="card card-absolute">
                        <div class="card-header bg-secondary">
                            <h5 class="text-white">Daftar Agent</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('user/req/post') }}" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="col-md-12">
                                    <label for="users_id" class="form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="users_id" id="users_id"
                                            value="{{ $auth->first_name }} {{ $auth->last_name }}" readonly disabled>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="no_nik" class="form-label">No Nik</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="no_nik" value=""
                                            id="no_nik">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="foto_ktp" class="form-label">Foto KTP</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="foto_ktp" value=""
                                            id="foto_ktp">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="no_sim" class="form-label">No SIM</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="no_sim" value=""
                                            id="no_sim">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="tgl_berakhir_sim" class="form-label">Tgl Berakhir SIM </label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_berakhir_sim"
                                            value="" id="tgl_berakhir_sim">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="foto_sim" class="form-label">Foto SIM</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="foto_sim" value=""
                                            id="foto_sim">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="jenis_sim" class="form-label">Jenis SIM</label>
                                    <div class="col-sm-10">
                                        <select class="js-example-basic-single col-sm-12" name="jenis_sim"
                                            id="jenis_sim">
                                            <option value="">-- Select Jenis SIM --</option>
                                            <option value="A">SIM A</option>
                                            <option value="C">SIM C</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="no_plat_kendaraan" class="form-label">No Plat Kendaraan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="no_plat_kendaraan"
                                            value="" id="no_plat_kendaraan">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                                    <div class="col-sm-10">
                                        <select class="js-example-basic-single col-sm-12" name="jenis_kendaraan"
                                            id="jenis_kendaraan">
                                            <option value="">-- Select Jenis SIM --</option>
                                            <option value="mobil">Mobil</option>
                                            <option value="motor">Motor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <label for="foto_stnk" class="form-label">Foto STNK</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="foto_stnk" value=""
                                            id="foto_stnk">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mt-4">Ajukan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @pushOnce('js')
        <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
        <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
        <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    @endPushOnce
@endsection

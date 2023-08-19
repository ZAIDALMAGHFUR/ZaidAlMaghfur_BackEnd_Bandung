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
            <h3>Pengembalian Mobile</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Sewa</li>
              <li class="breadcrumb-item active">Pengembalian Mobile</li>
            </ol>
          </div>
          <div class="col-sm-6">
            <!-- Bookmark Start-->
            <div class="bookmark">
              <ul>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
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
                <h5 class="text-white">Kembalikan Mobil</h5>
              </div>
              <div class="card-body">
                <form method="post" action="{{ route('user/retrunt/retruntCar') }}">
                  @csrf
                  @method('POST')
                  <div class="col-md-12">
                    <label for="plat_nomor" class="form-label">Plat Nomor</label>
                    <div class="col-sm-10">
                        <input  type="text" class="form-control" name="plat_nomor" id="plat_nomor" value="" >
                    </div>
                </div>
                  <div class="col-md-12 mt-4">
                      <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                      <div class="col-sm-10">
                          <input  type="date" class="form-control" name="tanggal_sewa" value="" id="tanggal_sewa">
                      </div>
                  </div>
                  <button type="submit" class="btn btn-success mt-4">Kembalikan</button>
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

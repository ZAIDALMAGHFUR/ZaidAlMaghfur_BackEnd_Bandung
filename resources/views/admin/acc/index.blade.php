@extends('layouts.app')
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
                        <h3>Acc User To Agent</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
                            <li class="breadcrumb-item">Data Master</li>
                            <li class="breadcrumb-item active">Acc User To Agent</li>
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
                            <table class="display table table-bordered" id="basic-1">
                                <thead>
                                    <tr style="text-align: center">
                                        <th style="width: 55px">No</th>
                                        <th>Nama User</th>
                                        <th>No NIK</th>
                                        <th>Foto KTP</th>
                                        <th>No SIM</th>
                                        <th>Masa Aktif SIM</th>
                                        <th>Foto SIM</th>
                                        <th>Jenis SIM</th>
                                        <th>No Plat Kendaraan</th>
                                        <th>Jenis Kendaraan</th>
                                        <th>Foto STNK</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($acc as $item)
                                        <tr style="text-align: center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->user->first_name }} {{ $item->user->last_name }}</td>
                                            <td>{{ $item->no_nik }}</td>
                                            <td><img src="{{ asset('storage/' . $item->foto_ktp) }}" alt=""
                                                    width="60px"></td>
                                            <td>{{ $item->no_sim }}</td>
                                            <td>{{ $item->tgl_berakhir_sim }}</td>
                                            <td><img src="{{ asset('storage/' . $item->foto_sim) }}" alt=""
                                                    width="60px"></td>
                                            <td>{{ $item->jenis_sim }}</td>
                                            <td>{{ $item->no_plat_kendaraan }}</td>
                                            <td>{{ $item->jenis_kendaraan }}</td>
                                            <td><img src="{{ asset('storage/' . $item->foto_stnk) }}" alt=""
                                                    width="60px"></td>
                                            <td>{{ $item->status_berkas }}</td>
                                            <td>
                                                <form action="{{ route('admin/user/acc/acc', ['id' => $item->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Verifikasi</button>
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
        <script type="text/javascript">
            $('.show_confirm').click(function(e) {
                var form = $(this).closest("form");
                e.preventDefault();
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                                // timer: 3000
                            });
                            form.submit();
                        } else {
                            swal("Your imaginary file is safe!", {
                                icon: "info"
                            });
                        }
                    })
            });
        </script>
        <script>
            @if (session()->has('success'))
                toastr.success(
                    '{{ session('success') }}',
                    'Wohoooo!', {
                        showDuration: 300,
                        hideDuration: 900,
                        timeOut: 900,
                        closeButton: true,
                        newestOnTop: true,
                        progressBar: true,
                    }
                );
            @elseif (session()->has('error'))
                toastr.error(
                    '{{ session('error') }}',
                    'Whoops!', {
                        showDuration: 300,
                        hideDuration: 900,
                        timeOut: 900,
                        closeButton: true,
                        newestOnTop: true,
                        progressBar: true,
                    }
                );
            @endif
        </script>
    @endPushOnce
@endsection

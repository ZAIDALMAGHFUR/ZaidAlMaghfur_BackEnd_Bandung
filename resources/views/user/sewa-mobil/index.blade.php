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
                        <h3>Mobile</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
                            <li class="breadcrumb-item">Data Sewa</li>
                            <li class="breadcrumb-item active">Mobile</li>
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
                    <div class="card-header">
                        <a href="{{ route('user/sewa/create') }}" class="btn btn-primary">Add Sewa</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered" id="basic-1">
                                <thead>
                                    <tr style="text-align: center">
                                        <th style="width: 55px">No</th>
                                        <th>Nama Mobile</th>
                                        <th>Plat Nomor</th>
                                        <th>Nama User</th>
                                        <th>Tanggal Sewa</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Harga</th>
                                        <th>Status Sewa</th>
                                        <th>Lama Sewa</th>
                                        <th>Status Pengembalian</th>
                                        <th>Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sewa_mobil as $item)
                                        <tr style="text-align: center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->mobil->nama_mobil }}</td>
                                            <td>{{ $item->mobil->plat_nomor }}</td>
                                            <td>{{ $item->user->first_name }} {{ $item->user->last_name }}</td>
                                            <td>{{ $item->tanggal_sewa }}</td>
                                            <td>{{ $item->tanggal_kembali }}</td>
                                            <td>Rp. {{ $item->total_harga }}</td>
                                            <td>
                                                @if ($item->status_sewa == 'failed')
                                                    <span class="badge badge-danger">Gagal</span>
                                                @elseif($item->status_sewa == 'pending')
                                                    <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                                @elseif($item->status_sewa == 'paid')
                                                    <span class="badge badge-success">Sudah Bayar</span>
                                                @endif
                                            </td>
                                            <td>{{ $masa_sewa[$loop->index] }} hari</td>
                                            <td>
                                                @if ($item->status_pengembalian == 'sudah dikembalikan')
                                                    <span class="badge badge-success">Sudah Dikembalikan</span>
                                                @elseif($item->status_pengembalian == 'belum dikembalikan')
                                                    <span class="badge badge-warning">Delum Dikembalikan</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->payment_status == 'paid')
                                                    <span class="text-success">Sudah Bayar</span>
                                                @else
                                                    <a href="{{ route('user/sewa/pay', $item->id) }}">
                                                        <button type="submit" class="btn btn-primary mt-3" id="pay-button">Bayar</button>
                                                    </a>
                                                @endif
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
        {{-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-41A5ZoIT0ufyNw1p"></script>
    <script>
        const payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();

            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        });
    </script> --}}
    @endPushOnce
@endsection

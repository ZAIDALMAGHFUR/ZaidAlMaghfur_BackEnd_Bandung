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
                        <h3>Pay Mobile</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
                            <li class="breadcrumb-item">Data Sewa</li>
                            <li class="breadcrumb-item active">Pay Mobile</li>
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
                            <h5 class="text-white">Pay Mobil</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($sewa as $item)
                                <tr style="text-align: center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mobil->nama_mobil }}</td>
                                    <td>{{ $mobil->plat_nomor }}</td>
                                </tr>
                            @endforeach
                            <button type="submit" class="btn btn-primary mt-3" id="pay-button">Pay</button>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-41A5ZoIT0ufyNw1p"></script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();

        snap.pay('{{ $get }}', {
            // Optional
            onSuccess: function(result) {
                console.log(result);

                if (result.status_code == '200') {
                    // Update the status of the mobile and sewa
                    const mobileId = '{{ $mobil->id }}';
                    const sewaId = '{{ $sewa->id }}';
                    const url = '/update-status/' + mobileId + '/' + sewaId;

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status_mobil: 'Di Sewa',
                            status_sewa: 'paid',
                            payment_status: 'paid'
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire({
                                icon: 'success',
                                title: 'Payment successful!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            },
            // Optional
            onPending: function(result) {
                console.log(result);
            },
            // Optional
            onError: function(result) {
                console.log(result);
            }
        });
    });
</script>
    @endPushOnce
@endsection

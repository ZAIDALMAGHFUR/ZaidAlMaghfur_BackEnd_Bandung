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
                <h5 class="text-white">Pay Mobil</h5>
              </div>
              <div class="card-body">
                @foreach ($sewa as $item)
                <tr style="text-align: center">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $mobil->nama_mobil}}</td>
                  <td>{{ $mobil->plat_nomor}}</td>
                  {{-- <td>{{ $auth->first_name }} {{ $item->user->last_name }}</td> --}}
                  {{-- <td>{{ $item->tanggal_sewa }}</td>
                  <td>{{ $item->tanggal_kembali}}</td>
                  <td>Rp. {{ $item->total_harga}}</td> --}}
                  {{-- <td>
                    @if ($item->status_sewa == 'failed')
                      <span class="badge badge-danger">Gagal</span>
                    @elseif($item->status_sewa == 'pending')
                      <span class="badge badge-warning">Menunggu Konfirmasi</span>
                    @elseif($item->status_sewa == 'paid')
                      <span class="badge badge-success">Sudah Bayar</span>
                    @endif
                  </td> --}}
                  {{-- <td>{{ $masa_sewa[$loop->index] }} hari</td>
                  <td>
                    @if ($item->status_pengembalian == 'sudah dikembalikan')
                      <span class="badge badge-success">Sudah Dikembalikan</span>
                    @elseif($item->status_pengembalian == 'belum dikembalikan')
                      <span class="badge badge-warning">Delum Dikembalikan</span>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('user/sewa/pay', $item->id) }}"><button type="submit" class="btn btn-primary mt-3" id="pay-button">Bayar</button></a>
                  </td> --}}
                </tr>



              @endforeach
              <button type="submit" class="btn btn-primary mt-3" id="pay-button">Save</button>
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

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-41A5ZoIT0ufyNw1p"></script>
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
        </script>

  @endPushOnce


@endsection
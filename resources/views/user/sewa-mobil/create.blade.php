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
          <h3>Sewa Mobile</h3>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
            <li class="breadcrumb-item">Data MMaster</li>
            <li class="breadcrumb-item active">Sewa Mobile</li>
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
  <div class="container-fluid">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <div class="col-lg-12">
              <div class="card p-3">
                <form method="post" class="needs-validation" novalidate="" action="{{ route('user/sewa/store') }}" enctype="multipart/form-data">
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
                        <label for="mobil_id" class="form-label">Name Mobil</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-single col-sm-12" name="mobil_id" id="mobil_id">
                                    <option value="">-- Select Mobil --</option>
                                    @foreach ($mobil as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_mobil }} - {{ $item->status_mobil }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <label for="id_users" class="form-label">Nama Penyewa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="id_users" value="{{ $auth }}" id="id_users" required disabled readonly>
                        </div>
                    </div>
                  </div>

                  <div class="row g-2">
                    <div class="col-md-6">
                        <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tanggal_sewa" value="{{ old('tanggal_sewa') }}" id="tanggal_sewa" required>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" id="tanggal_kembali" required>
                        </div>
                    </div>
                  </div>

                  {{-- <div class="row g-2">
                    <div class="col-md-6">
                        <label for="total_harga" class="form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="total_harga" id="total_harga" required readonly disabled>
                        </div>
                    </div>
                  </div> --}}

                  <button type="submit" class="btn btn-primary mt-3" id="pay-button">Save</button>
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

@endsection

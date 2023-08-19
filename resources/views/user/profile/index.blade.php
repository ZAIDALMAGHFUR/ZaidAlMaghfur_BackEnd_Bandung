@extends('layouts.tes')
@section('content')
  @pushOnce('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
  @endPushOnce
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>Settings</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Applications</a></li>
              <li class="breadcrumb-item">Settings</li>
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
      <div class="edit-profile">
        <div class="row">
          <div class="col-xl">
            <div class="card">
              <div class="card-header pb-0">
                <h4 class="card-title mb-0">My Profile</h4>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
              </div>
              <div class="card-body">

                <form method="post" class="needs-validation" novalidate="" action="{{ route('user/profile/update', [$user]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="form-group row align-items-start">
                    <label for="text" class="col-sm-3 font-weight-bold col-form-label">
                      <i class="icon-user"></i>
                      First Name
                    </label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="first_name" value="{{ old('name_mata_kuliah', $user->first_name) }}" id="first_name"
                            placeholder="Masukkan Nama yang sekarang">
                        <span class="invalid-feedback d-block error-text first_name_error"></span>
                    </div>
                </div>
                <div class="form-group row align-items-start">
                    <label for="text" class="col-sm-3 font-weight-bold col-form-label">
                      <i class="icon-user"></i>
                      Last Name
                    </label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="last_name" value="{{ old('name_mata_kuliah', $user->last_name) }}" id="last_name"
                            placeholder="Masukkan Nama yang sekarang" >
                        <span class="invalid-feedback d-block error-text last_name_error"></span>
                    </div>
                </div>


                <div class="form-group row align-items-start">
                    <label for="text" class="col-sm-3 font-weight-bold col-form-label">
                      <i class="icon-user"></i>
                      Email
                    </label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="email" value="{{ old('name_mata_kuliah', $user->email) }}" id="email"
                            placeholder="Masukkan Nama yang sekarang" >
                        <span class="invalid-feedback d-block error-text email_error"></span>
                    </div>
                </div>


                <div class="form-group row align-items-start">
                    <label for="text" class="col-sm-3 font-weight-bold col-form-label">
                      <i class="icon-user"></i>
                      Phone Number
                    </label>

                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="phone_number" value="{{ old('name_mata_kuliah', $user->phone_number) }}" id="phone_number"
                            placeholder="Masukkan Nama yang sekarang" >
                        <span class="invalid-feedback d-block error-text phone_number_error"></span>
                    </div>
                </div>

                <div class="form-group row align-items-start">
                    <label for="text" class="col-sm-3 font-weight-bold col-form-label">
                      <i class="icon-user"></i>
                      Adress
                    </label>

                    <div class="col-sm-9">
                        <input type="longText" class="form-control" name="address" value="{{ old('name_mata_kuliah', $user->address) }}" id="address"
                            placeholder="Masukkan Nama yang sekarang" >
                        <span class="invalid-feedback d-block error-text address_error"></span>
                    </div>
                </div>


                <div class="form-group row align-items-start">
                    <label for="text" class="col-sm-3 font-weight-bold col-form-label">
                      <i class="icon-user"></i>
                      No SIm
                    </label>

                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="no_sim" value="{{ old('name_mata_kuliah', $user->no_sim) }}" id="no_sim"
                            placeholder="Masukkan Nama yang sekarang" >
                        <span class="invalid-feedback d-block error-text no_sim_error"></span>
                    </div>
                </div>




                <div class="form-group row align-items-start">
                    <label for="password" class="col-sm-3 font-weight-bold col-form-label">
                      <i class="icofont icofont-ui-password"></i>
                        PW Lama
                    </label>

                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="oldpass" id="oldpass"
                            placeholder="Masukkan password yang sekarang">
                        <span class="invalid-feedback d-block error-text oldpass_error"></span>
                    </div>
                </div>

                <div class="form-group row align-items-start">
                    <label for="password" class="col-sm-3 font-weight-bold col-form-label">
                      <i class="icofont icofont-ui-password"></i>
                        PW Baru
                    </label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="newpass" id="newpass"
                            placeholder="Masukkan password baru">
                        <span class="invalid-feedback d-block error-text newpass_error"></span>
                    </div>
                </div>

                <div class="form-group row align-items-start">
                    <label for="emailSet" class="col-sm-3 font-weight-bold col-form-label">
                      <i class="icofont icofont-ui-password"></i>
                        Konfirmasi PW
                    </label>
                    <div class="col-sm-9">
                        <input id="confirmpass" type="password" class="form-control"
                            name="confirmpass" placeholder="Konfirmasi password baru">
                        <span class="invalid-feedback d-block error-text confirmpass_error"></span>
                    </div>

                </div>

                <div class="form-group row align-items-start">
                  <label for="foto" class="col-sm-3 font-weight-bold col-form-label">
                      FOTO
                  </label>
                  <div class="col-sm-9">
                      <input type="file" class="form-control" name="foto" id="foto"
                          >
                  </div>
              </div>

                <div class="form-group m-0 p-0 row">
                    <div class="offset-sm-3 col-sm-9">
                        <button type="submit" class="btn btn-primary btnPass">Perbarui</button>
                    </div>
                </div>
            </form>
              </div>
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
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    <script type="text/javascript">
      // Sweetalert Delete Confirmation
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

      // Alert Toastr for delete
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
      @endif
    </script>
  @endPushOnce
@endsection

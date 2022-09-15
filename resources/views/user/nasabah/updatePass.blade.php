@extends('layouts.starter')
@section('title')
    Ganti Password
@endsection

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary shadow mb-4">
                    <div class="card-header py-3">
                        @if (session()->has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                style="margin-top: 10px;">
                                {{ session('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif (session()->has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="margin-top: 10px;">
                                {{ session('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body justify-content-between">

                        {{-- start fo card pilih sampah --}}
                        <form method="POST" action="{{ route('nasabah.gantiPass') }}" class="d-inline" id="formChangePass">
                            <div class="form-col">
                                @csrf
                                <div class="row mb-3">
                                    <label>Password Sekarang</label>
                                    <input type="password" id="current_pwd" name="current_pwd" value=""
                                        class="form-control" required>
                                    <span id="ceknowPwd"></span>
                                </div>
                                <div class="row mb-3">
                                    <label>Masukkan Password baru</label>
                                    <input type="password" name="new_pwd" id="new_pwd" value="" class="form-control"
                                        required>

                                </div>
                                <div class="row mb-3">
                                    <label>Konfirmasi Password</label>
                                    <input type="password" name="confirm_pwd" id="confirm_pwd" value=""
                                        class="form-control" required>

                                </div>
                            </div>

                            <button class="btn btn-primary float-right mt-3"><i class="fas fa-key"></i> Ganti
                                Password</button>
                        </form>


                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
@endsection

@push('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('') }}plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#current_pwd").keyup(function() {
                var current_pwd = $("#current_pwd").val();
                $.ajax({
                    type: 'post',
                    url: '/nasabah/cekPwd',
                    data: {
                        current_pwd: current_pwd
                    },
                    success: function(resp) {
                        if (resp == "false") {
                            $("#ceknowPwd").html(
                                "<font color=red>current pass is incorrect</font>");
                        } else if (resp == "true") {
                            $("#ceknowPwd").html(
                                "<font color=green>current pass is correct</font>");
                        }
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            });
        });
    </script>
@endpush

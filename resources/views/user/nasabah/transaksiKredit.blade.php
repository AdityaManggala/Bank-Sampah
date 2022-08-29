@extends('layouts.starter')
@section('title')
    Manajemen Transaksi
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
                <div class="container-fluid">

                    <div class="card card-primary shadow mb-4">
                        <div class="card-header py-3">
                            <div class="card-title">Detail Transaksi</div>
                            <a href="" class="btn btn-info float-right">Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mt-3">
                                        <form action="{{ route('nasabah.substractSaldo') }}" class="d-inline">
                                            <label>Total</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"> <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text" name="saldo_nasabah" value="{{ $saldo }}"
                                                    class="form-control currency" readonly="">
                                            </div>
                                            <label>Nominal yang ingin diambil</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"> <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" name="kredit" value=""
                                                    class="form-control currency" min="10000" max="{{ $saldo }}">
                                                <input type="hidden" name="id" value="{{ $nasabah_id }}"
                                                    class="form-control">
                                                <input type="hidden" name="id_transaksi" value="{{ $transaksi_id }}"
                                                    class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-primary float-right mt-3">Check
                                                Out</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col-lg-12 -->
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
@endpush

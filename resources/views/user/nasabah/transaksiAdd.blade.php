@extends('layouts.starter')
@section('title')
    Manajemen Transaksi Nasabah
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
                            <div class="card-title">Tambah Transaksi</div>
                            <a href="{{ route('transaksi-nasabah.index') }}" class="btn btn-info float-right">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transaksi-nasabah.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <!-- penambahan data transaksi -->
                                        <label for="">Nasabah : </label>
                                        <select name="nasabah_id" class="form-control">
                                            @foreach ($nasabah as $anggota)
                                                <option value="{{ $anggota->id }}">{{ $anggota->nama_nasabah }}</option>
                                            @endforeach
                                        </select>
                                        <select name="tipe_transaksi" class="form-control">
                                            <option value="debit">Debit</option>
                                            <option value="kredit">Kredit</option>
                                        </select>
                                        <input type="hidden" name="admin_id" value="{{ auth()->user()->id }}" class="form-control" required>
                                        <input type="hidden" name="status" value="1" class="form-control" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right mt-3">Daftar</button>
                            </form>
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

@extends('layouts.starter')
@section('title')
    Manajemen Nasabah
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
                            <a href="" class="btn btn-info float-right">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col">
                                        <!-- penambahan data transaksi -->
                                        <label for="">Pelanggan : </label>
                                        <select name="idPelanggan" class="form-control">
                                            
                                        </select>
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
    </div>
@endsection

<!-- Tambah Modal-->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Penambahan nasabah -->
                <form action="{{ route('nasabah.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <label for="">Nama Nasabah Baru :</label>
                            <input type="text" name="nama_nasabah" class="form-control" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="">Alamat :</label>
                            <input type="text" name="alamat_nasabah" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">No. Rekening :</label>
                            <input type="text" name="no_rekening" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Keluarga :</label>
                            <input type="text" name="jml_keluarga" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tgl. Gabung :</label>
                            <input type="date" name="tgl_msk" class="form-control" required>
                        </div>
                        <input type="hidden" name="password" value="123" class="form-control">

                    </div>
            </div>


            <div class="modal-footer justify-content-between">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

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

@extends('layouts.starter')
@section('title')
    Data Transaksi yang telah Anda lakukan
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Transaksi</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>

                                    <th>Nama Admin</th>
                                    <th>No. rekening</th>
                                    <th>Tgl. Transaksi Dimulai</th>
                                    <th>Tgl. Transaksi Selesai</th>
                                    <th>Tipe Transaksi</th>
                                    <th>Nominal (Rp.)</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trnasabah as $transaksi)
                                    <tr class="odd gradeX">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->admin->username }}</td>
                                        <td>{{ $transaksi->nasabah->no_rekening }}</td>
                                        <td>{{ $transaksi->created_at }}</td>
                                        <td>
                                            @if ($transaksi->status == 1)
                                                Transaksi Belum Selesai
                                            @else
                                                {{ $transaksi->updated_at }}
                                            @endif
                                        </td>
                                        <td>{{ $transaksi->tipe_transaksi }}</td>
                                        <td>Rp. {{ $transaksi->grand_total_harga }}</td>
                                        <td>
                                            @if ($transaksi->status == 1)
                                                <span class="badge badge-warning">belum selesai</span>
                                            @elseif ($transaksi->status == 0)
                                                <span class="badge badge-danger">Dibatalkan</span>
                                            @else
                                                <span class="badge badge-success">Sudah Checkout</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Admin</th>
                                    <th>No. rekening</th>
                                    <th>Tgl. Transaksi Dimulai</th>
                                    <th>Tgl. Transaksi Selesai</th>
                                    <th>Tipe Transaksi</th>
                                    <th>Nominal (Rp.)</th>
                                    <th>aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
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
@endpush

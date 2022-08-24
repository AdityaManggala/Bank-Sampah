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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Transaksi</h3>
                        <a class="btn btn-primary btn-icon-split float-right" href="{{ route('index.transaksi') }}">
                            <span class="icon text-white-50">
                                <i class="fas fa-user-plus"></i>
                            </span><span class="text">Tambah</span>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Nasabah</th>
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
                                        <td>{{ $transaksi->nasabah->nama_nasabah }}</td>
                                        <td>{{ $transaksi->admin->username }}</td>
                                        <td>{{ $transaksi->nasabah->no_rekening }}</td>
                                        <td>{{ $transaksi->created_at }}</td>
                                        <td>
                                            @if ($transaksi->status==1)
                                            Transaksi Belum Selesai
                                            @elseif ($transaksi->status==0)
                                            Transaksi Dibatalkan
                                            @else
                                            {{ $transaksi->updated_at }}
                                                
                                            @endif
                                        </td>
                                        <td>{{ $transaksi->tipe_transaksi }}</td>
                                        <td>{{ $transaksi->grand_total_harga }}</td>
                                        <td>
                                            <form action="{{ route('detail-transaksi-nasabah.show', $transaksi->id) }}" class="d-inline">
                                                <button class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Nasabah</th>
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

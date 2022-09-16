@extends('layouts.starter')
@section('title')
    Manajemen Transaksi Pengepul
@endsection

@push('css')
    <!-- DataTables -->
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @endpush
@section('content')
    <div class="section-body">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Transaksi</h3>
                        <a class="btn btn-primary btn-icon-split float-right" href="{{ route('transaksi-pengepul.create') }}">
                            <span class="icon text-white-50">
                                <i class="fas fa-user-plus"></i>
                            </span><span class="text">Tambah</span>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Admin</th>
                                    <th>Nama Pengepul</th>
                                    <th>Nominal (Rp.)</th>
                                    <th>status</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tr as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $item->created_at }}</th>
                                    <th>{{ $item->admin->username }}</th>
                                    <th>{{ $item->nama_pengepul }}</th>
                                    <th>{{ $item->grand_total_harga }}</th>
                                    <th>    @if ($item->status == 1)
                                                <span class="badge badge-pill badge-danger">Belum Selesai</span>
                                            @else
                                                <span class="badge badge-pill badge-success">Telah Selesai</span>
                                            @endif
                                        </th>
                                    <th>
                                        <a href="{{ route('transaksi-pengepul.show',$item->id) }}" class="btn btn-warning edit"><i class="fas fa-edit"></i></a>
                                    </th>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Admin</th>
                                    <th>Nama Pengepul</th>
                                    <th>Nominal (Rp.)</th>
                                    <th>status</th>
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
    <script src="{{ asset('') }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script> --}}
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
    {{-- <script>
    $(function() {
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaksi-pengepul.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'admin_id', name: 'admin_id'},
                {data: 'grand_total_harga', name: 'grand_total_harga'},
                {data: 'nama_pengepul', name: 'nama_pengepul'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    </script> --}}
@endpush

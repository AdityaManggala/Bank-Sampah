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
                            <div class="card-title">Detail Transaksi</div>
                            <a href="{{ route('transaksi-nasabah.index') }}" class="btn btn-info float-right">Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mt-3">
                                        <label>Total</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend"> <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input type="text" name="grand_total_harga"
                                                @foreach ($dtrans as $detrans) value="{{ $detrans->transaksiNasabah->grand_total_harga }}" @endforeach
                                                class="form-control currency" readonly="">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary shadow mb-4">
                        <div class="card-header py-3">
                            <div class="card-title">Table Keranjang </div>
                        </div>
                        <div class="card-body">

                            {{-- start of table --}}
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sampah</th>
                                        <th>Harga Sampah Per Satuan (Rp.)</th>
                                        <th>Kuantitas</th>
                                        <th>Jenis Satuan Sampah</th>
                                        <th>Subtotal Harga (Rp.)</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dtrans as $dtrans)
                                        <tr class="odd gradeX">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dtrans->sampah->nama_sampah }}</td>
                                            <td>Rp. {{ $dtrans->sampah->harga_sampah }}</td>
                                            <td>{{ $dtrans->kuantitas }}</td>
                                            <td>{{ $dtrans->sampah->jenisSatuanSampah->nama_jenis_satuan }}</td>
                                            <td>Rp. {{ $dtrans->subtotal_harga }}</td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sampah</th>
                                        <th>Harga Sampah Per Satuan (Rp.)</th>
                                        <th>Kuantitas</th>
                                        <th>Jenis Satuan Sampah</th>
                                        <th>Subtotal Harga (Rp.)</th>
                                        
                                    </tr>
                                </tfoot>
                            </table>
                            {{-- End Of table --}}
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

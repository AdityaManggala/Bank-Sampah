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
                            <div class="card-title">Keranjang :
                                @foreach ($transaksi as $trans)
                                    {{ $trans->nasabah->nama_nasabah }}
                                @endforeach
                            </div>
                            <a href="" class="btn btn-info float-right">Kembali</a>
                        </div>
                        <div class="card-body">

                            {{-- start fo card pilih sampah --}}
                            <form action="{{ route('detail-transaksi-nasabah.store') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="">Pilih Sampah : </label>
                                        <select name="sampah_id" class="form-control">
                                            @foreach ($sampah as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_sampah }} /
                                                    {{ $item->jenisSatuanSampah->nama_jenis_satuan }} /
                                                    {{ $item->jenisHargaSampah->nama_jenis_harga }} /
                                                    Rp. {{ $item->harga_sampah }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label for="">Jumlah Sampah</label>
                                        <input type="number" step="any" name="kuantitas" class="form-control">
                                        @foreach ($transaksi as $trans)
                                            <input type="hidden" name="transaksi_nasabah_id" class="form-control"
                                                value="{{ $trans->id }}">
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right mt-3">Tambah Ke Keranjang</button>
                            </form>
                            {{-- end of pilih sampah --}}

                            <form action="{{ route('checkout.transaksi') }}" method="POST" class="float-right mt-3"
                                onsubmit="return confirm('Yakin Ingin Checkout?')">
                                @csrf
                                @method('post')
                                @foreach ($transaksi as $trans)
                                    <input type="hidden" name="transaksi_nasabah_id" class="form-control"
                                        value="{{ $trans->id }}">
                                @endforeach
                                <button class="btn btn-primary"><i class="fa fa-user"></i> checkout</button>
                            </form>

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
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($det_transaksi as $dtrans)
                                        <tr class="odd gradeX">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dtrans->sampah->nama_sampah }}</td>
                                            <td>Rp. {{ $dtrans->sampah->harga_sampah }}</td>
                                            <td>{{ $dtrans->kuantitas }}</td>
                                            <td>{{ $dtrans->sampah->jenisSatuanSampah->nama_jenis_satuan }}</td>
                                            <td>Rp. {{ $dtrans->subtotal_harga }}</td>
                                            <td>
                                                <button class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editModal{{ $dtrans->id }}"><i
                                                        class="fas fa-edit"></i></button>

                                                <!-- Edit Modal-->
                                                <div class="modal fade" id="editModal{{ $dtrans->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content bg-warning">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    Kuantitas Sampah :
                                                                    {{ $dtrans->nama_sampah }}</h5>
                                                                <button class="close" type="button" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body justify-content-between">
                                                                <form action="{{ route('detail-transaksi-nasabah.update', $dtrans->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="row">
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $dtrans->id }}">
                                                                        <div class="col">
                                                                            <label for="">Kuantitas :</label>
                                                                            <input type="text" name="kuantitas"
                                                                                value="{{ $dtrans->kuantitas }}"
                                                                                class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                        </div>
                        <form action="{{ route('detail-transaksi-nasabah.destroy', $dtrans->id) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Yakin Ingin hapus data')"">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        </td>
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
                                <th>aksi</th>
                            </tr>
                        </tfoot>
                        </table>
                        {{-- End Of table --}}
                    </div>
                </div>

            </div>
        </div>
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

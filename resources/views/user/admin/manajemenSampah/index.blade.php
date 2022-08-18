@extends('layouts.starter')
@section('title')
    Manajemen Sampah
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
                        <h3 class="card-title">Data Sampah</h3>
                        <a class="btn btn-primary btn-icon-split float-right" href="#" data-toggle="modal"
                            data-target="#tambahModal">
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
                                    <th>Nama Sampah</th>
                                    <th>Jenis Satuan</th>
                                    <th>Jenis harga</th>
                                    <th>harga Satuan</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sampah as $item)
                                    <tr class="odd gradeX">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_sampah }}</td>
                                        <td>{{ $item->jenisSatuanSampah->nama_jenis_satuan }}</td>
                                        <td>{{ $item->jenisHargaSampah->nama_jenis_harga }}</td>
                                        <td>{{ $item->harga_sampah }}</td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#editModal{{ $item->id }}"><i
                                                    class="fas fa-edit"></i></button>

                                            <!-- Edit Modal-->
                                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content bg-warning">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Sampah
                                                                :
                                                                {{ $item->nama_sampah }}</h5>
                                                            <button class="close" type="button" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body justify-content-between">
                                                            <form action="{{ route('sampah.update', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('put')
                                                                <div class="row">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $item->id }}">
                                                                    <div class="col">
                                                                        <label for="">Nama Sampah:</label>
                                                                        <input type="text" name="nama_sampah"
                                                                            value="{{ $item->nama_sampah }}"
                                                                            class="form-control" required>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="">Jenis Harga :</label>
                                                                        <select name="jenis_harga_sampah_id"
                                                                            class="form-control" required>
                                                                            <option value="">--Pilih--</option>
                                                                            @foreach ($harga as $pilihan)
                                                                                <option value="{{ $pilihan->id }}">
                                                                                    {{ $pilihan->nama_jenis_harga }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="">Jenis Satuan :</label>
                                                                        <select name="jenis_satuan_sampah_id"
                                                                            class="form-control" required>
                                                                            <option value="">--Pilih--</option>
                                                                            @foreach ($satuan as $pilihan)
                                                                                <option value="{{ $pilihan->id }}">
                                                                                    {{ $pilihan->nama_jenis_satuan }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="">Harga Sampah :</label>
                                                                        <input type="text" name="harga_sampah"
                                                                            placeholder="{{ $item->harga_sampah }}"
                                                                            class="form-control" required>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button class="btn btn-secondary" type="button"
                                                                data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                    </div>
                    <form action="{{ route('sampah.destroy', $item->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin Ingin hapus data')"">
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
                            <th>Jenis Satuan</th>
                            <th>Jenis harga</th>
                            <th>harga Satuan</th>
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

<!-- Tambah Modal-->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Penambahan Berat Satuan Sampah -->
                <form action="{{ route('sampah.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="">Nama Sampah :</label>
                            <input type="text" name="nama_sampah" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="">Jenis Sampah :</label>
                            <select name="jenis_harga_sampah_id" class="form-control" required>
                                <option value="">--Pilih--</option>
                                @foreach ($harga as $pilihan)
                                    <option value="{{ $pilihan->id }}">{{ $pilihan->nama_jenis_harga }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="">Jenis Satuan :</label>
                            <select name="jenis_satuan_sampah_id" class="form-control" required>
                                <option value="">--Pilih--</option>
                                @foreach ($satuan as $pilihan)
                                    <option value="{{ $pilihan->id }}">{{ $pilihan->nama_jenis_satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="">Harga Sampah :</label>
                            <input type="text" name="harga_sampah" class="form-control" required>
                        </div>
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

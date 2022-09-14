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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Nasabah</h3>
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
                                    <th>Username</th>
                                    <th>Nama Nasabah</th>
                                    <th>Alamat</th>
                                    <th>No. rekening</th>
                                    <th>Tgl. Masuk</th>
                                    <th>Saldo</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekening as $norek)
                                    <tr class="odd gradeX">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $norek->nasabah->username }}</td>
                                        <td>{{ $norek->nasabah->nama_nasabah }}</td>
                                        <td>{{ $norek->nasabah->alamat_nasabah }}</td>
                                        <td>{{ $norek->nasabah->no_rekening }}</td>
                                        <td>{{ $norek->nasabah->tgl_msk }}</td>
                                        <td>Rp. {{ $norek->saldo }}</td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#editModal{{ $norek->nasabah->id }}"><i
                                                    class="fas fa-edit"></i></button>

                                            <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#gantiPassModal{{ $norek->nasabah->id }}"><i class="fas fa-key"></i></button>

                                            <!-- Edit Modal-->
                                            <div class="modal fade" id="editModal{{ $norek->nasabah->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content bg-warning">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Sampah
                                                                :
                                                                {{ $norek->nasabah->nama_nasabah }}</h5>
                                                            <button class="close" type="button" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('nasabah.update', $norek->nasabah->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('put')
                                                                <div class="row">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $norek->nasabah->id }}">
                                                                    <div class="col">
                                                                        <label for="">Username Nasabah:</label>
                                                                        <input type="text" name="username"
                                                                            value="{{ $norek->nasabah->username }}"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="">Nama Nasabah:</label>
                                                                        <input type="text" name="nama_nasabah"
                                                                            value="{{ $norek->nasabah->nama_nasabah }}"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="">Alamat:</label>
                                                                        <input type="text" name="alamat_nasabah"
                                                                            value="{{ $norek->nasabah->alamat_nasabah }}"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="">No. Rekening:</label>
                                                                        <input type="text" name="no_rekening"
                                                                            value="{{ $norek->nasabah->no_rekening }}"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="">Jumlah Keluarga :</label>
                                                                        <input type="text" name="jml_keluarga"
                                                                            value="{{ $norek->nasabah->jml_keluarga }}"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="col">
                                                                        <label for="">Tgl. Gabung :</label>
                                                                        <input type="text" name="tgl_msk"
                                                                            value="{{ $norek->nasabah->tgl_msk }}"
                                                                            class="form-control"
                                                                            onfocus="(this.type='date')">
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

                                            {{-- ganti password modal --}}
                                            <div class="modal fade" id="gantiPassModal{{ $norek->nasabah->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content bg-warning">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ganti Password
                                                                :
                                                                {{ $norek->nasabah->nama_nasabah }}</h5>
                                                            <button class="close" type="button" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('nasabah.ubahPass', $norek->nasabah->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                
                                                                <div class="row">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $norek->nasabah->id }}">
                                                                    <div class="col">
                                                                        <label for="">Password :</label>
                                                                        <input type="password" name="password"
                                                                            class="form-control">
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
                    <form action="{{ route('nasabah.destroy', $norek->nasabah->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin Ingin hapus data ?')"">
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
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. rekening</th>
                            <th>Tgl. Masuk</th>
                            <th>Rata-rata Volume Sampah</th>
                            <th>Saldo</th>
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
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body justify-content-between">
                <!-- Penambahan nasabah -->
                <form action="{{ route('nasabah.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="">Nama Nasabah Baru :</label>
                            <input type="text" name="nama_nasabah" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="">Alamat :</label>
                            <input type="text" name="alamat_nasabah" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="">No. Rekening :</label>
                            <input type="text" name="no_rekening" class="form-control" required>
                        </div>
                        <div class="col-2">
                            <label for="">Jumlah Keluarga :</label>
                            <input type="text" name="jml_keluarga" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="">Tgl. Gabung :</label>
                            <input type="date" name="tgl_msk" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="">Password :</label>
                            <input type="password" name="password" class="form-control">
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

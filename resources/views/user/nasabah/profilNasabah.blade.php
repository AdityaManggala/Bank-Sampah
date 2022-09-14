@extends('layouts.starter')
@section('title')
    Data Diri Nasabah Bank-Sampah
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
                <div class="card card-primary shadow mb-4">
                    <div class="card-header py-3">
                        <div class="card-title">Profil :
                            @foreach ($nasabah as $data)
                                {{ $data->nama_nasabah }}
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body justify-content-between">

                        {{-- start fo card pilih sampah --}}

                        <div class="form-col">

                            <div class="row mb-3">
                                <label>Nama Nasabah</label>
                                @foreach ($nasabah as $data)
                                    <input type="text" id="nama_nasabah" value="{{ $data->nama_nasabah }}"
                                        class="form-control" readonly>
                                @endforeach
                            </div>
                            <div class="row mb-3">
                                <label>Username yang digunakan</label>
                                @foreach ($nasabah as $data)
                                    <input type="text" id="nama_nasabah" value="{{ $data->username }}"
                                        class="form-control" readonly>
                                @endforeach
                            </div>
                            <div class="row mb-3">
                                <label>Alamat Tempat Tinggal</label>
                                @foreach ($nasabah as $data)
                                    <input type="text" id="nama_nasabah" value="{{ $data->alamat_nasabah }}"
                                        class="form-control" readonly>
                                @endforeach
                            </div>
                            <div class="row mb-3">
                                <label>No. Rekening Nasabah</label>
                                @foreach ($nasabah as $data)
                                    <input type="text" id="nama_nasabah" value="{{ $data->no_rekening }}"
                                        class="form-control" readonly>
                                @endforeach
                            </div>
                            <div class="row">
                                <label>Jumlah keluarga</label>
                                @foreach ($nasabah as $data)
                                    <input type="text" id="nama_nasabah" value="{{ $data->jml_keluarga }}"
                                        class="form-control" readonly>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('nasabah.updPass')}}" class="btn btn-danger float-right mt-3"><i class="fas fa-key"></i> Ubah Password</a>
                        <button class="btn btn-warning float-left mt-3" data-toggle="modal" data-target="#editModal"><i
                                class="fa fa-user"></i> Ubah
                            Profil</button>



                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
@endsection

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Nasabah
                    :
                    @foreach ($nasabah as $ppl)
                        {{ $ppl->nama_nasabah }}
                    @endforeach
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('nasabah.editNasabah', Auth::id()) }}" method="POST">
                    @csrf
                    
                    <div class="col">
                        <input type="hidden" name="id"
                            @foreach ($nasabah as $ppl)
                            value="{{ $ppl->id }}"> @endforeach
                            <div class="row">
                        <label for="">Username Nasabah:</label>
                        <input type="text" name="username"
                            @foreach ($nasabah as $ppl)
                                value="{{ $ppl->username }}" @endforeach
                            class="form-control">
                    </div>
                    <div class="row">
                        <label for="">Nama Nasabah:</label>
                        <input type="text" name="nama_nasabah"
                            @foreach ($nasabah as $ppl)
                            value="{{ $ppl->nama_nasabah }}" @endforeach
                            class="form-control">
                    </div>
                    <div class="row">
                        <label for="">Alamat:</label>
                        <input type="text" name="alamat_nasabah"
                            @foreach ($nasabah as $ppl)
                            value="{{ $ppl->alamat_nasabah }}" @endforeach
                            class="form-control">
                    </div>
                    <div class="row">
                        <label for="">No. Rekening:</label>
                        <input type="text" name="no_rekening"
                            @foreach ($nasabah as $ppl)
                            value="{{ $ppl->no_rekening }}" @endforeach
                            class="form-control">
                    </div>
                    <div class="row">
                        <label for="">Jumlah Keluarga :</label>
                        <input type="text" name="jml_keluarga"
                            @foreach ($nasabah as $ppl)    
                        value="{{ $ppl->jml_keluarga }}" @endforeach
                            class="form-control">
                    </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>

    </form>
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

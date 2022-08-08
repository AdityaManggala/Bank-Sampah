@extends('layouts.starter')
@section('title')
    Manajemen Sampah
@endsection

{{-- @push('css')
    <!-- DataTables CSS -->
        <link href="{{ asset('') }}css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="{{ asset('') }}css/dataTables/dataTables.responsive.css" rel="stylesheet">
@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    Data Sampah
                    <div class="btn-group pull-right">
                        <a href="{{ route('sampah.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                                        <form action="{{ route('sampah.edit', ['sampah'=>$item->id]) }}" method="post" class="hidden-md">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit">edit</button>
                                        </form> --}}
                                        {{-- <a class="btn btn-warning" href="{{ route('sampah.edit', ['sampah'=>$item->id]) }}">edit</a> --}}
                                        {{-- <form action="{{ route('sampah.destroy', ['sampah'=>$item->id]) }}" method="post" class="hidden-sm">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="visible-lg-inline">delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
@endsection --}}

@push('script')
    <script src="{{ asset('') }}js/dataTables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}js/dataTables/dataTables.bootstrap.min.js"></script>
    <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
@endpush

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
                    <h3 class="card-title">Data Jenis Harga Sampah</h3>
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
                                {{-- <form action="{{ route('sampah.edit', ['sampah'=>$item->id]) }}" method="post" class="hidden-md">
                                    @csrf
                                    @method('PUT') --}}
                                    <button type="submit">edit</button>
                                {{-- </form> --}}
                                {{-- <a class="btn btn-warning" href="{{ route('sampah.edit', ['sampah'=>$item->id]) }}">edit</a> --}}
                                <form action="{{ route('sampah.destroy', ['sampah'=>$item->id]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="d-inline">delete</button>
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
    $(function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush


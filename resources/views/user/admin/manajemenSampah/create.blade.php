@extends('layouts.app')
@section('title')
    Manajemen Sampah
@endsection

{{-- @push('css')
    <!-- DataTables CSS -->
        <link href="{{ asset('') }}css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="{{ asset('') }}css/dataTables/dataTables.responsive.css" rel="stylesheet">
@endpush --}}

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tambah Data
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" action="{{ route('sampah.store') }}" method="POST">
                                @csrf
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Nama Sampah</span>
                                    <input type="text" class="form-control" placeholder="nama sampah" name="nama_sampah" >
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Harga Sampah</span>
                                    <input type="number" class="form-control" placeholder="harga sampah" name="harga_sampah">
                                    <span class="input-group-addon">.00</span>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Jenis Satuan</span>
                                    <select class="form-control" name="jenis_satuan_sampah_id">
                                        <option value="">pilih</option>
                                        @foreach ($satuan as $item )
                                        <option value="{{ $item->id }}">{{ $item->nama_jenis_satuan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">Jenis Harga</span>
                                    <select class="form-control" name="jenis_harga_sampah_id">
                                        <option value="">pilih</option>
                                        @foreach ($harga as $item )
                                        <option value="{{ $item->id }}">{{ $item->nama_jenis_harga }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
@endsection

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

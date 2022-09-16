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
    @if (session()->has('msg'))
        <div class="alert alert-danger" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Jenis Harga Sampah</h3>
                        <a class="btn btn-primary btn-icon-split float-right" data-toggle="modal"
                            data-target="#add-sampah-modal">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span><span class="text">Tambah</span></a>
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
                                        <a href="javascript:void(0)" class="btn btn-warning edit" data-id="{{ $item->id }}" 
                                            data-nama="{{ $item->nama_sampah }}" 
                                            data-jenis-satuan-id="{{ $item->jenisSatuanSampah->id }}"
                                            data-jenis-harga-id="{{ $item->jenisHargaSampah->id }}"
                                            data-harga-sampah="{{ $item->harga_sampah }}"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger delete" data-id="{{ $item->id }}" data-nama="{{ $item->nama_sampah }}"><i class="fa fa-trash"></i></a>
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

<!-- add data modal -->
<div class="modal fade" id="add-sampah-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Tambah Data Sampah</h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="AddSampahForm" name="AddSampahForm" class="form-horizontal" method="POST">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nama Sampah</span>
                        </div>
                        <input type="text" class="form-control" placeholder="nama sampah" name="nama_sampah" >
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Harga Sampah</span>
                        </div>
                        <input type="number" class="form-control" placeholder="harga sampah" name="harga_sampah">
                        <div class="input-group-prepend">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Jenis Satuan</span>
                        </div>
                        <select class="form-control" name="jenis_satuan_sampah_id" id="jenis_satuan_sampah_id">
                            <option value="">pilih</option>
                            @foreach ($satuan as $item )
                            <option value="{{ $item->id }}">{{ $item->nama_jenis_satuan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Jenis Harga</span>
                        </div>
                        <select class="form-control" name="jenis_harga_sampah_id" id="jenis_harga_sampah_id">
                            <option value="">pilih</option>
                            @foreach ($harga as $item )
                            <option value="{{ $item->id }}">{{ $item->nama_jenis_harga }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="">Save changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- end add data modal -->

<!-- update data modal -->
<div class="modal fade" id="update-sampah-modal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Edit Data Sampah</h4>
        </div>
        <div class="modal-body">
            <form action="javascript:void(0)" id="EditSampahForm" name="EditSampahForm" class="form-horizontal" method="POST">
                <input type="hidden" name="id" id="id_edit">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">Nama Sampah</span>
                    </div>
                    <input type="text" class="form-control" placeholder="nama sampah" name="nama_sampah" id="nama_sampah_edit" >
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Harga Sampah</span>
                    </div>
                    <input type="number" class="form-control" placeholder="harga sampah" name="harga_sampah" id="harga_sampah_edit">
                    <div class="input-group-prepend">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Jenis Satuan</span>
                    </div>
                    <select class="form-control" name="jenis_satuan_sampah_id" id="select-jenis-satuan">
                        <option value="">pilih</option>
                        @foreach ($satuan as $item )
                        <option value="{{ $item->id }}">{{ $item->nama_jenis_satuan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Jenis Harga</span>
                    </div>
                    <select class="form-control" name="jenis_harga_sampah_id" id="select-jenis-harga">
                        <option value="">pilih</option>
                        @foreach ($harga as $item )
                        <option value="{{ $item->id }}">{{ $item->nama_jenis_harga }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="btn-save" value="">Save changes
                    </button>
                </div>
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>
    </div>
</div>
<!-- end update data modal -->
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
<!-- SweetAlert2 -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Page specific script -->
<script>
    $(function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": true,"paging": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
    });
</script>

<script>
    $(document).ready(function($){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#AddSampahForm').submit(function () {
            var formData = $(this).serialize();
            // console.log(formData);
            
            var url = `{{ route('sampah.store') }}`;
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                dataType: "json",
                beforeSend: function() {
                    swal({
                        title: "Good job!",
                        text: "Data telah berhasil ditambah",
                        icon: "success",
                        buttons: false
                    });
                },
                success: function(data) {
                    setTimeout(() => {
                        location.reload()
                    }, 500);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR,textStatus,errorThrown);
                },
            });
        });

        $('body').on('click', '.edit', function () {

            //grab data
            var id = $(this).attr('data-id');
            var nama_sampah = $(this).attr('data-nama');
            var jenis_satuan_id = $(this).attr('data-jenis-satuan-id');
            var jenis_satuan_nama = $(this).attr('data-jenis-satuan-nama');
            var jenis_harga_id = $(this).attr('data-jenis-harga-id');
            var jenis_harga_nama = $(this).attr('data-jenis-harga-nama');
            var harga_sampah = $(this).attr('data-harga-sampah');
            
            $('#update-sampah-modal').modal('show');
            $('#id_edit').val(id);
            $('#nama_sampah_edit').val(nama_sampah);
            $('#select-jenis-satuan').val(jenis_satuan_id);
            $('#select-jenis-harga').val(jenis_harga_id);
            $('#harga_sampah_edit').val(harga_sampah);
        });

        $('#EditSampahForm').submit(function () {
            var formDataEdit = $(this).serialize();
            // console.log(formDataEdit);
            // serialize() untuk ambil data dari form
            var id = $('#id_edit').val();
            var url = `{{ route('sampah.update',':id') }}`;
            url = url.replace(':id', id);
            $.ajax({
                type: "PUT",
                url: url,
                data:formDataEdit,
                dataType: "json",
                beforeSend: function() {
                    swal({
                        title: "Good job!",
                        text: "Data telah berhasil diubah",
                        icon: "success",
                        buttons: false
                    });
                },
                success: function(data) {
                    setTimeout(() => {
                        location.reload()
                    }, 500);
                    // console.log(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR,textStatus,errorThrown);
                },
            });
        });

        $('body').on('click', '.delete', function () {
            var nama = $(this).attr('data-nama');
                swal({
                title: `Apakah yakin menghapus ${nama} dari daftar sampah ?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var id = $(this).data('id');
                    var url = `{{ route('sampah.destroy',':id') }}`;
                    url = url.replace(':id', id);
                    // ajax
                    $.ajax({
                        type:"DELETE",
                        url: url,
                        data: { id: id },
                        dataType: 'json',
                        
                        beforeSend: function() {
                            swal("Data Telah Dihapus", {
                                icon: "success",
                                buttons:false
                            },);
                        },
                        success: function(res){
                            setTimeout(() => {
                                location.reload()
                            }, 500);
                        },
                    });
                } else {
                    swal(`Data ${nama} Tidak Jadi Dihapus`);
                }
            });
        });

    });
</script>
@endpush

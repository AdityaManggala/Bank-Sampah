@extends('layouts.starter')
@section('title')
    Manejemen Jenis Satuan
@endsection

@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    {{-- <link rel="stylesheet" href="{{ asset('') }}plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"> --}}
@endpush

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Jenis Harga Sampah</h3>
                    
                        <a class="btn btn-primary btn-icon-split float-right" data-toggle="modal"
                            data-target="#add-jenis-satuan-modal">
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
                        <th>Jenis Satuan</th>
                        <th>aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($units as $unit)
                                    <tr class="odd gradeX">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $unit->nama_jenis_satuan }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-warning edit" data-id="{{ $unit->id }}" data-nama="{{ $unit->nama_jenis_satuan }}"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger delete" data-id="{{ $unit->id }}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Jenis Satuan</th>
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
<div class="modal fade" id="add-jenis-satuan-modal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Tambah Data jenis</h4>
        </div>
        <div class="modal-body">
        <form action="javascript:void(0)" id="AddJenisSatuanForm" name="AddJenisSatuanForm" class="form-horizontal" method="POST">
            <input type="hidden" name="id" id="id">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">nama</span>
                    </div>
                    <input type="text" class="form-control" id="nama_jenis_satuan" name="nama_jenis_satuan" placeholder="Nama Jenis" value="" maxlength="50" required="">
                </div>
            </div>  
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewSatuan">Save changes
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
<div class="modal fade" id="edit-jenis-satuan-modal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Edit Data Jenis</h4>
        </div>
        <div class="modal-body">
        <form action="javascript:void(0)" id="EditJenisSatuanForm" name="EditJenisSatuanForm" class="form-horizontal" method="POST">
            <input type="hidden" name="id" id="id_edit">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">nama</span>
                    </div>
                    <input type="text" class="form-control" id="nama_jenis_satuan_edit" name="nama_jenis_satuan" placeholder="Nama Jenis" value="" maxlength="50" required="">
                </div>
            </div>  
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewSatuan">Save changes
                </button>
            </div>
        </form>
        </div>
        <div class="modal-footer"></div>
    </div>
    </div>
</div>
<!-- end update modal -->
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
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
</script>

<script>
    $(document).ready(function($){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#AddJenisSatuanForm').submit(function () {
            var formData = $(this).serialize();
            // console.log(formData);
            
            var url = `{{ route('jenis-satuan-sampah.store') }}`;
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
            var id = $(this).attr('data-id');
            var nama_jenis_satuan = $(this).attr('data-nama');
            
            $('#edit-jenis-satuan-modal').modal('show');
            $('#id_edit').val(id);
            $('#nama_jenis_satuan_edit').val(nama_jenis_satuan);
        });

        $('#EditJenisSatuanForm').submit(function () {
            var formDataEdit = $(this).serialize();
            // serialize() untuk ambil data dari form
            var id = $('#id_edit').val();
            var url = `{{ route('jenis-satuan-sampah.update',':id') }}`;
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
                swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var id = $(this).data('id');
                    var url = `{{ route('jenis-satuan-sampah.destroy',':id') }}`;
                    url = url.replace(':id', id);
                // ajax
                $.ajax({
                    type:"DELETE",
                    url: url,
                    data: { id: id },
                    dataType: 'json',
                    
                    beforeSend: function() {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                            buttons:false
                        },);
                    },
                    success: function(res){
                        setTimeout(() => {
                            location.reload()
                        }, 500);                    
                    }
                });
                    
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
        }); 
    });
</script>
@endpush

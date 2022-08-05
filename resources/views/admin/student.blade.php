@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Managemen Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Manajemen</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-block btn-primary btn-flat" data-toggle="modal" data-target="#modal-create">Tambah Data</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table-student" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>Asal Sekolah</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  {{-- Modal tambah --}}
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="name">Nama Siswa</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="school">Asal Sekolah</label>
                        <input type="text" class="form-control" id="school" name="school">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="number">No HP</label>
                        <input type="text" class="form-control" id="number" name="number">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-submit">Simpan</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Update --}}
<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <input type="hidden" name="student_id" id="student_id">
                    <div class="form-group">
                        <label for="name">Nama Siswa</label>
                        <input type="text" name="updateName" id="updateName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="school">Asal Sekolah</label>
                        <input type="text" class="form-control" id="updateSchool" name="updateSchool">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="updateEmail" name="updateEmail">
                    </div>
                    <div class="form-group">
                        <label for="number">No HP</label>
                        <input type="text" class="form-control" id="updateNumber" name="updateNumber">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary btn-update">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready( function () {
        $('#table-student').DataTable();
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).ready(function () {
        fetch();

        function fetch() {
            $.ajax({
                type: "GET",
                url : "{{route('admin/studentFetch')}}",
                dataType :"json",
                success: function (response) {
                    $('tbody').html("");
                    $.each(response.student, function (key,item) {
                        $('tbody').append('<tr>\
                            <td>' + parseFloat(key + 1) + '</td>\
                            <td>' + item.name+ '</td>\
                            <td>' + item.school + '</td>\
                            <td>' + item.email + '</td>\
                            <td>' + item.phone_number + '</td>\
                            <td class="text-center"><button type="button" value="' + item.id + '" class="btn btn-warning edit_data">Edit</button>\
                                <button type="button" value="' + item.id + '" class="btn btn-danger btn_delete">Hapus</button>\
                            </td>\
                        \</tr>');
                    });
                    $('#table-student').DataTable();
                }
            });
        }

        $(document).on('click', '.btn-submit', function (e) {
            e.preventDefault();

            $(this).text('Progress....').attr('disabled', 'disabled')
            $('#table-student').DataTable().clear();
            $('#table-student').DataTable().destroy();
            var find = $('#table-student tbody').find('tr');
            if (find) {
                $('#table-student tbody').empty();
            }

            var data = {
                'name': $('#name').val(),
                'school': $('#school').val(),
                'email': $('#email').val(),
                'number': $('#number').val(),
            }

            $.ajax({
                type: "POST",
                url: "{{ route('admin/studentStore') }}",
                data: data,
                dataType: "json",
                success: function (data) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })
                    Toast.fire({
                    icon: data.status,
                    title: data.message
                    })
                },
                complete: function(err){
                    $('.btn-submit').text('Simpan').removeAttr('disabled')
                    $('#name').val(null).trigger('change');
                    $('#school').val(null);
                    $('#email').val(null);
                    $('#number').val(null);
                    $('#modal-create .close').click();
                    fetch();
                },
                error: function (err) {
                if (err.status == 422) {
                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[name="'+i+'"]');
                        el.after($('<span style="color: red;">'+error[0]+'</span>'));
                    });
                    $('.tambah_data').text('Simpan').removeAttr('disabled')
                }
                }
            });
        });

        $(document).on('click', '.edit_data', function (e) {
            e.preventDefault();
            var student_id = $(this).val();
            $('#modal-update').modal('show');
            $.ajax({
                type: "GET",
                url: "student-edit/" + student_id,
                success: function (response) {
                if (response != null){
                    const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })
                    Toast.fire({
                    icon: response.status,
                    title: response.message
                    })
                        $('#updateName').val(response.student.name);
                        $('#updateSchool').val(response.student.school);
                        $('#updateEmail').val(response.student.email);
                        $('#updateNumber').val(response.student.phone_number);
                        $('#student_id').val(response.student.id);
                    }
                },
                complete: function(err) {
                    fetch();
                    // $('#modal-update').modal('hide');
                },
                error: function (err) {
                    if (err.status == 422) {
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="'+i+'"]');
                            el.after($('<span style="color: red;">'+error[0]+'</span>'));
                        });
                    }
                }
            });
        });

      $(document).on('click', '.btn-update', function (e) {
        e.preventDefault();

        $(this).text('Progress....').attr('disabled', 'disabled')
        $('#table-student').DataTable().clear();
        $('#table-student').DataTable().destroy();
        var find = $('#table-student tbody').find('tr');
        if (find) {
            $('#table-student tbody').empty();
        }
        var id = $('#student_id').val();

        var data = {
            'name': $('#updateName').val(),
            'school': $('#updateSchool').val(),
            'email': $('#updateEmail').val(),
            'number': $('#updateNumber').val(),
        }

        $.ajax({
            type: "PUT",
            url: "student-update/" + id,
            data: data,
            dataType: "json",
            success: function (data) {
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                Toast.fire({
                  icon: data.status,
                  title: data.message
                })
              $('#modal-update').modal('hide');
            },
            complete: function(){
                    $('.update_data').text('Simpan').removeAttr('disabled')
                    $('#modal-update').modal('hide');
                    fetch();
            },
            error: function (err) {
                if (err.status == 422) { 
                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[name="'+i+'"]');
                        el.after($('<span style="color: red;">'+error[0]+'</span>'));
                    });
                }
            }
        });
      });

      $(document).on('click', '.btn_delete', function (e) {
        $('#table-student').DataTable().clear();
        $('#table-student').DataTable().destroy();
        var find = $('#table-student tbody').find('tr');
        if (find) {
            $('#table-student tbody' ).empty();
        }
        e.preventDefault();
        var student_id = $(this).val();
        Swal.fire({
                title: "Apa anda yakin ingin hapus data ini?!",
                text: "Jika menghapus data ini, maka anda tidak dapat mengembalikannya",
                type: "error",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    type: "DELETE",
                    url: "student-delete/" + student_id,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
                        Toast.fire({
                          icon: response.status,
                          title: response.message
                        })
                      }, 
                    complete: function() {
                      fetch();
                    }
                  });
                }
            })
      });
    });

    </script>
@endpush('script')

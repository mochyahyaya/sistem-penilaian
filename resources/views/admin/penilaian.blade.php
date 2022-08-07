@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Penilaian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Penilaian</li>
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
              {{-- <div class="card-header">
                <button type="button" class="btn btn-block btn-primary btn-flat" data-toggle="modal" data-target="#modal-create">Tambah Data</button>
              </div> --}}
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table-penilaian" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Nama Siswa</th>
                    <th>Ketepatan Waktu</th>
                    <th>Efisensi Kerja</th>
                    <th>Prosedur Kerja</th>
                    <th>Penguasaan Alat</th>
                    <th>Komunikasi</th>
                    <th>Nilai Total</th>
                    <th>Grade</th>
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
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Nilai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="name">Nama Siswa</label>
                        <select name="name" id="name" class="form-control">
                            <option value="" selected disabled >-- Pilih Siswa --</option>
                            @foreach ($users as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="time">Nilai Ketepatan Waktu</label>
                        <input type="text" class="form-control" id="time" name="time">
                    </div>
                    <div class="form-group">
                        <label for="efficency">Nilai Efisensi Kerja</label>
                        <input type="text" class="form-control" id="efficency" name="efficency">
                    </div>
                    <div class="form-group">
                        <label for="procedur">Nilai Prosedur Kerja</label>
                        <input type="text" class="form-control" id="procedur" name="procedur">
                    </div>
                    <div class="form-group">
                        <label for="tools">Nilai Penguasaan Alat</label>
                        <input type="text" class="form-control" id="tools" name="tools">
                    </div>
                    <div class="form-group">
                        <label for="communication">Nilai Komunikasi</label>
                        <input type="text" class="form-control" id="communication" name="communication">
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
            <h5 class="modal-title" id="exampleModalLabel">Edit Data Nilai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <input type="hidden" name="nilai_id" id="nilai_id">
                    {{-- <div class="form-group">
                        <label for="name">Nama Siswa</label>
                        <select name="updateName" id="updateName" class="form-control">
                            <option value="" selected disabled >-- Pilih Siswa --</option>
                            @foreach ($users as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div> --}} 
                    <div class="form-group">
                        <label for="time">Nilai Ketepatan Waktu</label>
                        <input type="text" class="form-control" id="updateTime" name="updateTime">
                    </div>
                    <div class="form-group">
                        <label for="efficency">Nilai Efisensi Kerja</label>
                        <input type="text" class="form-control" id="updateEfficency" name="updateEfficency">
                    </div>
                    <div class="form-group">
                        <label for="procedur">Nilai Prosedur Kerja</label>
                        <input type="text" class="form-control" id="updateProcedur" name="updateProcedur">
                    </div>
                    <div class="form-group">
                        <label for="tools">Nilai Penguasaan Alat</label>
                        <input type="text" class="form-control" id="updateTools" name="updateTools">
                    </div>
                    <div class="form-group">
                        <label for="communication">Nilai Komunikasi</label>
                        <input type="text" class="form-control" id="updateCommunication" name="updateCommunication">
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
        // $('#table-penilaian').DataTable({

        // });
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
                url : "{{route('admin/penilaianFetch')}}",
                dataType :"json",
                success: function (response) {
                    console.log(response.nilai);
                    $('tbody').html("");
                    $.each(response.nilai, function (key,item) {
                        var mean = (parseFloat(item.time) + parseFloat(item.efficency) + parseFloat(item.procedur) + parseFloat(item.tools) + parseFloat(item.communication)) / 5;
                        if(mean >= 0 && mean <= 60){
                            var grade = 'Buruk'
                        } else if (mean >= 60 && mean < 80) {
                            var grade = 'Cukup Baik'
                        } else if (mean >= 80 && mean <= 100) {
                            var grade = 'Baik'
                        } else if (mean == 0) {
                            var grade = 'Belum diinput'
                        }

                        $('tbody').append('<tr>\
                            <td>' + parseFloat(key + 1) + '</td>\
                            <td>' + moment(item.created_at).locale('id').format('LL') + '</td>\
                            <td>' + item.users.name + '</td>\
                            <td>' + item.time + '</td>\
                            <td>' + item.efficency + '</td>\
                            <td>' + item.procedur + '</td>\
                            <td>' + item.tools + '</td>\
                            <td>' + item.communication + '</td>\
                            <td>' + mean + '</td>\
                            <td>' + grade + '</td>\
                            <td class="text-center"><button type="button" value="' + item.id + '" class="btn btn-primary edit_data">Edit</button>\
                            </td>\
                        \</tr>');
                    });
                    $('#table-penilaian').DataTable();
                }
            });
        }

        $(document).on('click', '.btn-submit', function (e) {
            e.preventDefault();

            $(this).text('Progress....').attr('disabled', 'disabled')
            $('#table-penilaian').DataTable().clear();
            $('#table-penilaian').DataTable().destroy();
            var find = $('#table-penilaian tbody').find('tr');
            if (find) {
                $('#table-penilaian tbody').empty();
            }

            var data = {
                'name': $('#name').val(),
                'time': $('#time').val(),
                'efficency': $('#efficency').val(),
                'tools': $('#tools').val(),
                'procedur' : $('#procedur').val(), 
                'communication' : $('#communication').val(), 
            }

            $.ajax({
                type: "POST",
                url: "{{ route('admin/penilaianStore') }}",
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
                    $('#time').val(null);
                    $('#efficency').val(null);
                    $('#procedur').val(null);
                    $('#tools').val(null);
                    $('#communication').val(null);
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
            var nilai_id = $(this).val();
            $('#modal-update').modal('show');
            $.ajax({
                type: "GET",
                url: "penilaian-edit/" + nilai_id,
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
                        $('#updateTime').val(response.nilai.time);
                        $('#updateEfficency').val(response.nilai.efficency);
                        $('#updateProcedur').val(response.nilai.procedur);
                        $('#updateTools').val(response.nilai.tools);
                        $('#updateCommunication').val(response.nilai.communication);
                        $('#nilai_id').val(response.nilai.id);
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
        $('#table-penilaian').DataTable().clear();
        $('#table-penilaian').DataTable().destroy();
        var find = $('#table-penilaian tbody').find('tr');
        if (find) {
            $('#table-penilaian tbody').empty();
        }
        var id = $('#nilai_id').val();
        console.log(id);

        var data = {
            'time': $('#updateTime').val(),
            'efficency': $('#updateEfficency').val(),
            'tools': $('#updateTools').val(),
            'procedur' : $('#updateProcedur').val(), 
            'communication' : $('#updateCommunication').val(), 
        }

        $.ajax({
            type: "PUT",
            url: "penilaian-update/" + id,
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
                    $('.btn-update').text('Simpan').removeAttr('disabled')
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
    });

    </script>
@endpush('script')

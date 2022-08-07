@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Kegiatan & Nilai</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Kegiatan & Nilai</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <div class="content">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-block btn-primary btn-flat" data-toggle="modal" data-target="#modal-create">Input Kegiatan</button>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-striped table-valign-middle" id="table-nilai">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Aktivitas</th>
                    <th>Ketepatan Waktu</th>
                    <th>Efisensi Kerja</th>
                    <th>Prosedur Kerja</th>
                    <th>Penguasaan Alat</th>
                    <th>Komunikasi</th>
                    <th>Total Nilai</th>
                    {{-- <th>Grade</th> --}}
                </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($nilai as $value)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($value->created_at)->format('d M Y')}}</td>
                            <td>{{$value->activity}}</td>
                            <td>{{$value->time}}</td>
                            <td>{{$value->efficency}}</td>
                            <td>{{$value->procedur}}</td>
                            <td>{{$value->tools}}</td>
                            <td>{{$value->communication}}</td>
                            <td>{{($value->time + $value->efficency + $value->procedur + $value->tools + $value->communication) / 5}}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

{{-- Create modal --}}
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Input Kegiatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
              <form action="">
                  <div class="form-group">
                      <label for="communication">Nama Kegiatan</label>
                      <input type="text" class="form-control" id="activity" name="activity">
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
@endsection

@push('script')

<script>
$(document).ready(function () {
  $('#table-nilai').DataTable();
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
      url : "{{route('student/nilaiFetch')}}",
      dataType :"json",
      success: function (response) {
          console.log(response.nilai);
          $('tbody').html("");
          $.each(response.nilai, function (key,item) {
            var mean = (parseFloat(item.time) + parseFloat(item.efficency) + parseFloat(item.procedur) + parseFloat(item.tools) + parseFloat(item.communication)) / 5;
              $('tbody').append('<tr>\
                  <td>' + parseFloat(key + 1) + '</td>\
                  <td>' + moment(item.created_at).locale('id').format('LL') + '</td>\
                  <td>' + item.activity + '</td>\
                  <td>' + item.time + '</td>\
                  <td>' + item.efficency + '</td>\
                  <td>' + item.procedur + '</td>\
                  <td>' + item.tools + '</td>\
                  <td>' + item.communication + '</td>\
                  <td>' + mean + '</td>\
              \</tr>');
          });
          $('#table-nilai').DataTable();
      }
    });
  }

  $(document).on('click', '.btn-submit', function (e) {
    e.preventDefault();

    $(this).text('Progress....').attr('disabled', 'disabled')
    $('#table-nilai').DataTable().clear();
    $('#table-nilai').DataTable().destroy();
    var find = $('#table-nilai tbody').find('tr');
    if (find) {
        $('#table-nilai tbody').empty();
    }

    var data = {
        'activity': $('#activity').val()
    }

    $.ajax({
        type: "POST",
        url: "{{ route('student/nilaiStore') }}",
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
            $('#activity').val(null);
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

});

</script>
    
@endpush
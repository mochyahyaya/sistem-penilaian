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
                    <th>Nama Siswa</th>
                    <th>Sekolah</th>
                    <th>Ketepatan Waktu</th>
                    <th>Efisensi Kerja</th>
                    <th>Prosedur Kerja</th>
                    <th>Penguasaan Alat</th>
                    <th>Komunikasi</th>
                    <th>Nilai Total</th>
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
@endsection

@push('script')
<script>
    $(document).ready(function () {
        fetch();

        function fetch() {
            $.ajax({
                type: "GET",
                url : "{{route('admin/laporanFetch')}}",
                dataType :"json",
                success: function (response) {
                    console.log(response.laporan);
                    $('tbody').html("");
                    $.each(response.laporan, function (key,item) {
                    var mean = (parseFloat(item.time) + parseFloat(item.efficency) + parseFloat(item.procedur) + parseFloat(item.tools) + parseFloat(item.communication)) / 5;
                        $('tbody').append('<tr>\
                            <td>' + parseFloat(key + 1) + '</td>\
                            <td>' + item.name + '</td>\
                            <td>' + item.school + '</td>\
                            <td>' + item.time + '</td>\
                            <td>' + item.efficency + '</td>\
                            <td>' + item.procedur + '</td>\
                            <td>' + item.tools + '</td>\
                            <td>' + item.communication + '</td>\
                            <td>' + mean + '</td>\
                        \</tr>');
                    });
                    $('#table-penilaian').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'copyHtml5',
                                title: 'Laporan Nilai Siswa Magang'
                            },
                            {
                                extend: 'excelHtml5',
                                title: 'Laporan Nilai Siswa Magang'

                            },
                            {
                                extend: 'pdfHtml5',
                                title: 'Laporan Nilai Siswa Magang'

                            },
                            'colvis'
                        ]      
                    });
                }
            });
        }
    })
</script>
    
@endpush
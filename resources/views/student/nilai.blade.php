@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Lihat Nilai</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Lihat Nilai</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <div class="content">
        <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Nilai</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-striped table-valign-middle">
                <thead>
                <tr>
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
                    @foreach ($nilai as $value)
                        <tr>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->activity}}</td>
                            <td>{{$value->time}}</td>
                            <td>{{$value->efficency}}</td>
                            <td>{{$value->procedur}}</td>
                            <td>{{$value->tools}}</td>
                            <td>{{$value->communication}}</td>
                            <td>{{($value->time + $value->efficency + $value->procedur + $value->tools + $value->communication) / 5}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
    </div>
      </div>
@endsection
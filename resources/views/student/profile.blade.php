@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
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
              <form id="update-profile">
                <div class="card-body">
                  @foreach ($student as $value)
                  <div class="form-group">
                    <label for="name">Nama Siswa</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$value->name}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$value->email}}">
                  </div>
                  <div class="form-group">
                    <label for="school">Asal Sekolah</label>
                    <input type="text" class="form-control" id="school" name="school" value="{{$value->school}}">
                  </div>
                  <div class="form-group">
                    <label for="school">Nomor HP</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$value->phone_number}}">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{$value->password}}">
                  </div>
                </div>
                  @endforeach
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
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
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $("form#update-profile").submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize() 
        // var data =  $(this).serialize()
        // console.log(formData);
        $.ajax({
            url: "{{route('student/profileUpdate')}}",
            type  : 'put',
            data: data,
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
        });
    });
})

</script>
    
@endpush
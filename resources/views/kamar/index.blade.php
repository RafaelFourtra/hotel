@extends('layouts.master')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Kamar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Daftar Kamar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal1"><i class="fa fa-plus-circle"></i> Tambah</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Kamar</th>
                    <th>Harga Kamar</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($kamar as $kmr)
                    <tr>
                        <th scope="row">{{$kmr->id_kamar}}</th>
                        <td>{{$kmr->nama_kamar}}</td>
                        <td>{{number_format($kmr->harga_booking)}}</td>
                        <td><a href="/edit/{{ $kmr->id_kamar }}" class="btn btn-warning">Edit</a>
                            <a href="/delete/{{ $kmr->id_kamar }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                 @endforeach
                  </tbody>
                </table>
              </div>

            </div>

    </section>
    <!-- /.content -->


    <!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kamar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('kamar.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="exampleInputName">Nama Kamar</label>
            <input type="text" name="nama_kamar" class="form-control" id="exampleInputName">
        </div>
        <div class="form-group">
            <label for="exampleInputName">Harga Kamar</label>
            <input type="number" name="harga_booking" class="form-control" id="exampleInputName">
        </div>
      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

@isset($dataskamar)
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/update/{{ $dataskamar->id_kamar }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputName">Nama Kamar</label>
            <input type="text" name="nama_kamar" class="form-control" id="exampleInputName" value="{{ $dataskamar->nama_kamar}}">
        </div>
        <div class="form-group">
            <label for="exampleInputName">Harga Kamar</label>
            <input type="number" name="harga_booking" class="form-control" id="exampleInputName" value="{{ $dataskamar->harga_booking }}">
        </div>
      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endisset

<script>
$(document).ready(function(){
      $("#exampleModal2").modal("show");
});
</script>
@include('sweetalert::alert')
    @endsection
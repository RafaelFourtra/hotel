@extends('layouts.master')
@section('content')
@php
$akumulasiPenjualan = 0;
@endphp
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Bulanan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Laporan Bulanan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card">
            <div class="card-header">
            <div class="row">  
                <div class="col-lg-1">
                
                </div>
                  <div class="col-lg-6">
                  </div>
                  <div class="col-lg-5">
                      <form class="form-inline" action="/laporanbulanan" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="datefrom" class="mx-1">From</label>
                            <input type="date"  id="datefrom" class="form-control" name="datefrom">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="dateto" class="mx-1">To</label>
                            <input type="date"  id="dateto" class="form-control" name="dateto">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </form>
                  </div>
                </div>
            </div>
                <div class="card-body">
    
                <table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
        <th scope="col">Tanggal</th>
        <th scope="col">Cash</th>
        <th scope="col">Red Doorz</th>
        <th scope="col">Total</th>
        <th scope="col">Akumulasi Penjualan</th>
        </tr>
    </thead>
    <tbody>
       
    @foreach ($data as $dt)
    @php
            $akumulasiPenjualan += $dt["total"];
        @endphp
    <tr>
        <td>{{ $dt["tanggal"]}}</td>
        <td>{{ $dt["cash"] }}</td>
        <td>{{ $dt["reddoorz"] }}</td>
        <td>{{ $dt["total"]}}</td>
        <td>{{ $akumulasiPenjualan}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ url('/exportlaporanbulanan/' . (isset($datefrom) ? $datefrom : '-') . '/' . (isset($dateto) ? $dateto : '-') ) }}" class="btn btn-primary mb-2 float-right"><i class="fa fa-download" aria-hidden="true"></i></a>
                </div>
            </div>

    </section>
    <!-- /.content -->
    @endsection
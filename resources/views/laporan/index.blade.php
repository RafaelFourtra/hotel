@extends('layouts.master')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Harian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Laporan Harian</li>
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
                      <form class="form-inline" action="/laporan" method="POST">
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
        <th scope="col">No</th>
        <th scope="col">Cash</th>
        <th scope="col">Red Doorz</th>
        <th scope="col">Total</th>
       
        </tr>
    </thead>
    <tbody>
        @php 
            $totalcash = 0;
            $totalreddoorz = 0;
            $current_date = '';
        @endphp
    @foreach ($data as $dt)
    @php 
        if($dt->payment_method == "Cash"){
            $totalcash += $dt->transaksi_jumlah;
        }
        if($dt->payment_method == "Red Doorz"){
            $totalreddoorz += $dt->transaksi_jumlah;
        }
        else{

        }
    @endphp
    <tr>
        <td>{{$current_date != $dt->transaksi_date ? $dt->transaksi_date : "" }}</td>
        <td>{{  $dt->no_nota }}</td>
        <td>{{ $dt->payment_method == "Cash" ? $dt->transaksi_jumlah : "" }}</td>
        <td>{{ $dt->payment_method == "Red Doorz" ? $dt->transaksi_jumlah : "" }}</td>
        </tr>
        
        @php 
            $current_date = $dt->transaksi_date
        @endphp
        @endforeach
        <tr>
        <td colspan="2">Jumlah</td>
        <td>{{ $totalcash }}</td>
        <td>{{ $totalreddoorz }}</td>
        <td>{{ $totalcash + $totalreddoorz }}</td>
    </tr>
    </tbody>
</table>
<a href="{{ url('/exportlaporan/' . (isset($datefrom) ? $datefrom : '-') . '/' . (isset($dateto) ? $dateto : '-') ) }}" class="btn btn-primary mb-2 float-right"><i class="fa fa-download" aria-hidden="true"></i></a>
                </div>
            </div>

    </section>
    <!-- /.content -->
    @endsection
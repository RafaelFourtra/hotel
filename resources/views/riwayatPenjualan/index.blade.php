@extends('layouts.master')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Riwayat Transaksi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Riwayat Transaksi</li>
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
            <div class="row">  
                <div class="col-lg-1">
                <a href="{{ route('penjualan.index') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
                </div>
                  <div class="col-lg-6">
                  </div>
                  <div class="col-lg-5">
                      <form class="form-inline" action="/searchfromdate" method="GET">
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
                    <div class="row">
                        <div class="col-lg-12">
                        <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Check In</th>
                                    <th scope="col">Check Out</th>
                                    <th scope="col">Metode</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Pembayaran</th>
                                    <th scope="col">Kembalian</th>
                                    <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($transaksi as $trans)
                                    <tr>
                                    <td>{{$trans->no_nota}}</td>
                                    <td>{{$trans->transaksi_date}}</td>
                                    <td>{{$trans->nama}}</td>
                                    <td>{{$trans->addres}}</td>
                                    <td>{{$trans->contact}}</td>
                                    <td>{{$trans->check_in}}</td>
                                    <td>{{$trans->check_out}}</td>
                                    <td>{{$trans->payment_method}}</td>
                                    <td>{{number_format($trans->transaksi_jumlah)}}</td>
                                    <td>{{number_format($trans->payment)}}</td>
                                    <td>{{number_format($trans->returning_charge)}}</td>
                                        <td><a href="/detailriwayat/{{ $trans->id }}" class="btn btn-primary">Detail</a>
                                            <a  href="{{url('/riwayatpenjualan/cetakstruk/'.$trans->id)}}" class="btn btn-primary" id_nota="{{$trans->id}}"><i class="fa fa-print"></i></td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

    </section>
    <!-- /.content -->


@isset($detailbooking)
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th scope="col">No Kamar</th>
                                        <th scope="col">Ukuran Kasur</th>
                                        <th scope="col">Hari</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($detailbooking as $detail)
                                        <tr>
                                        <td>{{ $detail-> kamar -> no_kamar}}</td>
                                        <td>{{ $detail-> kamar -> bed_size}}</td>
                                        <td>{{ $detail-> day}}</td>
                                        <td>{{ number_format($detail->harga)}}</td>
                                        <td>{{  number_format($detail->total_harga)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                        </table>        
      </div>
    </div>
  </div>
</div>


@endisset
@isset($lastIDorder)
<div id="print" style="visibility: hidden;">
 @include('receipt.receipt')
 </div>
<script>
    
    var data = '<input type="button" id="printPageButton" class="printPageButton" style="display: block; width:100%; border:none; background-color: #008B8B; color:#fff; padding: 14px 28px; font-size:16px; cursor:pointer; text-align:center" value="Print Receipt"" onClick="window.print()">';
                data += document.getElementById("print").innerHTML;
           
              
                myReceipt = window.open("", "myWin", "left=150, top=130, width=400, height=400");
              
                    myReceipt.screenX = 0;
                    
                    myReceipt.screenY = 0;
                    myReceipt.document.write(data);
                    myReceipt.document.title = "Print Receipt";
                  
                myReceipt.focus();
                setTimeout(() => {
                    myReceipt.close();
                },20000);

          
    
</script>
@endisset

<script>
$(document).ready(function(){
      $("#exampleModal").modal("show");
});
</script>
@include('sweetalert::alert')
    @endsection
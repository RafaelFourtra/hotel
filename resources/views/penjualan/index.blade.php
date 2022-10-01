@extends('layouts.master')
@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kasir</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item">Kasir</li>
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
            </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                        <form action="{{ route('penjualan.store') }}" method="post">
                            @csrf
                        <div class="card-body">
                        <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th></th>
                                        <th scope="col">Kamar</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Hari</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Total</th>
                                        <th><a href="#" class="btn btn-sm btn-success  rounded-circle" id="add_order"><i class="fa fa-plus-circle"></i></a></th>

                                        </tr>
                                    </thead>
                                    <tbody class="addMoreOrder">
                                        <tr>
                                        <td>1</td>
                                        <td>
                                        <select class="form-control id_kamar" id="id_kamar" name="id_kamar[]">
                                            <option value="">Select Item</option>
                                            @foreach($kamars as $kamar)
                                                <option data-harga='{{ $kamar->harga_booking }}' data-size='{{ $kamar->bed_size }}' value='{{ $kamar->id_kamar }}'>{{ $kamar->no_kamar }}</option> 
                                            @endforeach 
                                        </select>
                                        </td>
                                        <td>
                                            <input type="text" name="size[]" id="size" class="form-control size">
                                        </td>
                                        <td>
                                            <input type="number" name="day[]" id="day" class="form-control day">
                                        </td>
                                        <td>
                                            <input type="number" name="harga[]" id="harga" class="form-control harga">
                                        </td>
                                        <td>
                                            <input type="number" name="total_harga[]" id="total_harga" class="form-control total_harga">
                                        </td>
                                        <td>
                                        <a href="" class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times"></i></a>
                                        </td>
                                        </tr>
                                    </tbody>
                        </table>
                        </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card-header">
                                <h4>Total <b class="total">0.00</b></h4>
                            </div>
                            <input type="hidden" name="transaksi_jumlah" class="total-input">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="customer_name">Nama</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name">
                                    </div>
                                    </div>
                                    <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="customer_address">Alamat</label>
                                        <input type="text" class="form-control" id="customer_addres" name="customer_addres">
                                    </div>
                                    </div>
                                    <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="customer_contact">Contact</label>
                                        <input type="number" class="form-control" id="customer_contact" name="customer_contact">
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="check_in">Check In</label>
                                        <input type="date" class="form-control" id="check_in" name="check_in">
                                    </div>
                                    </div>
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="check_out">Check Out</label>
                                        <input type="date" class="form-control" id="check_out" name="check_out">
                                    </div>
                                    </div>
                                </div>
                                <h6>Metode Pembayaran</h3>
                                <div class="row">
                                    <div class="col-lg-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios1" value="Cash" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Cash
                                        </label>
                                    </div>
                                    </div>
                                    <div class="col-lg-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="exampleRadios1" value="Red Doorz" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Red Doorz
                                        </label>
                                    </div>
                                    </div>
                                </div>
                                    <div class="form-group mt-4">
                                        <label for="payment">Pembayaran</label>
                                        <input type="number" class="form-control" name="payment" id="payment">
                                    </div>
                                    <div class="form-group">
                                        <label for="returning_charge">Kembalian</label>
                                        <input type="number" class="form-control  bg-light text-dark" name="returning_charge" id="returning_charge" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>


    </section>
<div class="modal">
</div>




@include('sweetalert::alert')
@endsection
@section('script')
<script>
        $(".myList").hide();
 
        $('#add_order').on('click', function(e) {
 
        var kamar = $(".id_kamar").html();
        var numberofrow = ($('.addMoreOrder tr').length - 0) + 1;
        var tr = '<tr><td class="no">' + numberofrow + '</td>' +
            '<td><select class="form-control id_kamar" name="id_kamar[]">' + kamar + '</select></td>' +
            '<td> <input type="text" name="size[]" class="form-control size"></td>' +
            '<td> <input type="number" name="day[]" class="form-control day"></td>' +
            '<td> <input type="number" name="harga[]" class="form-control harga"></td>' +
            '<td> <input type="number" name="total_harga[]" class="form-control total_harga"></td>' +
            '<td><a href="" class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times"></i></a></td>'; 
            $('.addMoreOrder').append(tr);
        });

        $('.addMoreOrder').delegate('.delete', 'click', function(e){
        e.preventDefault();
        $(this).parent().parent().remove();
        });

        function TotalHarga(){
            var total = 0;
            $('.total_harga').each(function(i,e){
                var amount = $(this).val() - 0;
                total += amount;
            });

            $('.total').html(total);
            $('.total-input').val(total);
        };

        $('.addMoreOrder').delegate('.id_kamar', 'change', function(){
            var tr = $(this).parent().parent();
            var harga = tr.find('.id_kamar option:selected').attr('data-harga');
            tr.find('.harga').val(harga);
            var size = tr.find('.id_kamar option:selected').attr('data-size');
            tr.find('.size').val(size);
            var day = tr.find('.day').val() - 0;
            var harga = tr.find('.harga').val() - 0;
            var size = tr.find('.size').val() - 0;
            var total_harga = (day * harga);
            tr.find('.total_harga').val(total_harga);
            TotalHarga();
        });
        
        $('.addMoreOrder').delegate('.day', 'keyup', function(){
            var tr = $(this).parent().parent();
            var harga = tr.find('.id_kamar option:selected').attr('data-harga');
            tr.find('.harga').val(harga);
            var size = tr.find('.id_kamar option:selected').attr('data-size');
            tr.find('.size').val(size);
            var day = tr.find('.day').val() - 0;
            var harga = tr.find('.harga').val() - 0;
            var size = tr.find('.size').val() - 0;
            var total_harga = (day * harga);
            tr.find('.total_harga').val(total_harga);
            TotalHarga();
        });

        $('#payment').keyup(function() {
            var total = $('.total').html();
            var payment = $(this).val();
            var tot = payment - total;
            $('#returning_charge').val(tot).toFixed(2);
        });

</script>
@endsection
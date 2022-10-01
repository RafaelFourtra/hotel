<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Laporan Harian</title>
</head>
<body>

<h3 class="text-center">Laporan Harian</h3>
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
</body>
</html>
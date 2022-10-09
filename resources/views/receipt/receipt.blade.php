<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
      *{
        font-family: 'Roboto', sans-serif;
     }
      #invoice-pos {
            box-shadow: 00 1in -0.25in rgb(0,0,0.5);
            padding:2mm;
            margin: 0 auto;
            width:80mm;
            background: #fff;
        }
        #invoice-pos::selection {
            background: #34495e;
            color:#fff;
        }
        #invoice-pos::-moz-selection{
            background:#34495e;
            color:#fff;
        }
        #invoice-pos h1{
            font-size: 1.5em;
            font-weight:bold;
        }
        #invoice-pos .namebrand{
            font-size: 1.7em;
            font-weight:bold;
        }
        #invoice-pos .contactus{
            font-size: 1.2em;
            font-weight:bold;
        }
        #invoice-pos #h2-title{
            font-size:1em;
            font-weight:bolder;
        }
        #invoice-pos #p-list{
            font-size:1em;
            font-weight:normal;
        }
        #invoice-pos h3{
            font-size: 1.2em;
            font-weight:300;
            line-height: 2em;
            font-weight:bold;
        }
        #invoice-pos p{
            font-size: 0.7em;
            color:black;
            font-weight:bold;
            line-height: 1.2em;
        }
        #invoice-pos #top, #invoice-pos #mid, #invoice-pos #bot{
            border-bottom: 1px solid #eee;
        }
        #invoice-pos #top{
            min-height: 100px;;
        }
        #invoice-pos #mid{
            min-height: 80px;;
        }
        #invoice-pos #bot{
            min-height: 50px;;
        }
        #invoice-pos #top .logo{
            height: 60px;
            width: 60px;
            background-image: url() no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }
        #invoice-pos .info {
            display: block;
            margin-left: 0;
            text-align: center;
        }
        #invoice-pos .title{
            float: right;
        }
        #invoice-pos .title p{
            text-align: right;
        }
        #invoice-pos table{
            width:100%;
            border-collapse: collapse;
        }
        #invoice-pos .tabletitle{
            font-size: 0.5em;
            background: #eee;
        }
        #invoice-pos .service{
            border-bottom: 1px solid #eee;
        }
        #invoice-pos .item{
            width: 24mm;
        }
        #invoice-pos .totalall{
            font-size: 1em;
            font-weight: bold;
        }
        #invoice-pos #legalcopy{
            margin-top: 5mm;
          
        }
        .serial-number{
            margin-top: 5mm;
            margin-bottom: 2mm;
            text-align: center;
            font-size: 12px;
            font-weight: bolder;
        }
        .serial{
            font-size: 10px !important;
            font-weight: bolder;
        }
    </style>
</head>
<body>
<div id="invoice-pos">
    <div id="printed-content">

        <center id="logo">
            <div class="logo"></div>
            <div class="info"></div>
            <h2 class="namebrand">Tumesa</h2>
        </center>
        </div>
        
        <div class="mid">
            <div class="info">
                <p>
                    Address : Jl. Wologito V No.52-49, RW.01, Kembangarum, Kec. Semarang Barat, Kota Semarang, Jawa Tengah<br>
                    Phone : 0804 104 0040
                </p>
            </div>
            <div class="info-customer">
                <p>
                    Nama: {{$lastIDorder -> nama}}<br>
                    Contact: {{$lastIDorder -> contact}}<br>
                    {{$lastIDorder -> payment_method}}
                </p>
            </div>
        </div>
        <div class="bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td id="h2-title" class="no_kamar"><h2>No Kamar</h2></td>
                        <td id="h2-title" class="bed_size"><h2>Bed Size</h2></td>
                        <td id="h2-title" class="hari"><h2>Hari</h2></td>
                        <td id="h2-title" class="harga"><h2>Harga</h2></td>
                        <td id="h2-title" class="total_harga"><h2>Total</h2></td>
                    </tr>
                    @foreach ($order_receipt as $receipt)
                    <tr class="service">
                        <td id="p-list" class="no_kamar"><p class="itemtext">{{ $receipt-> kamar -> no_kamar }}</p></td>
                        <td id="p-list" class="bed_size"><p class="itemtext">{{ $receipt-> kamar -> bed_size }}</p></td>
                        <td id="p-list" class="hari"><p class="itemtext">{{ $receipt-> day }}</p></td>
                        <td id="p-list" class="harga"><p class="itemtext">{{ number_format($receipt->harga) }}</p></td>
                        <td id="p-list" class="total_harga"><p class="itemtext">{{ number_format($receipt->total_harga) }}</p> </td>
                    </tr>
                    @endforeach
                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td id="h2-title" class="payment_amount"><h2>Sub Total</h2></td>
                        <td id="h2-title" class="payment"><h2>Pembayaran</h2></td>
                        <td id="h2-title" class="returning"><h2>Kembalian</h2></td>
                    </tr>
                    <tr class="service">
                        <td></td>
                        <td></td>
                        <td  id="p-list" class="payment_amount"><p class="itemtext">{{ number_format($order_receipt->sum('total_harga')) }}</p></td>
                        <td  id="p-list" class="payment"><p class="itemtext">{{ number_format ($orderedBy [0]-> payment) }}</p></td>
                        <td  id="p-list" class="returning"><p class="itemtext">{{ number_format ($orderedBy[0]-> returning_charge) }}</p></td>
                    </tr>
                </table>

                <div class="legalcopy">
                    <p class="legal"><strong> ** Thank you for visiting ** 
                    </strong><br>
                    The good which are subject to tax, prices inccludes tax
                    </p>
                </div>
                <div class="serial-number">
                    No Nota: <span class="serial">
                    {{$lastIDorder -> no_nota}}
                    </span><br>
                    Date: <span class="serial">
                    {{$lastIDorder -> transaksi_date}}
                    </span>
                </div>
            </div>
        </div>
</div>


</body>
</html>


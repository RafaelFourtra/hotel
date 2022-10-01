<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Transaksi;
use App\Models\BookingDetail;

class RiwayatPenjualanController extends Controller
{
    public function index(Request $req){
        $transaksi = Transaksi::with("bookingdetail")->whereRaw('Date(transaksi_date) = CURDATE()')->get();
        //dd("ds");
        return view("riwayatPenjualan.index", ["transaksi"=>$transaksi]);
    }

    public function show($id){
        $transaksi = Transaksi::with("bookingdetail")->get();
        $detailbooking = BookingDetail::where('id_transaksi', $id)->get();
        return view("riwayatPenjualan.index", ["transaksi"=>$transaksi,"detailbooking"=>$detailbooking]);

    }


    public function print($id){
        $transaksi = Transaksi::with("bookingdetail")->get();
        $checking = Transaksi::where("id",$id)->pluck("payment_method")->first();
        $lastIDorder = Transaksi::where("id",$id)->first();
        $order_receipt = BookingDetail::with("kamar")->where('id_transaksi', $id)->get();
        $orderedBy = Transaksi::where('id', $id)->get();

      

        return view("riwayatPenjualan.index", ["transaksi"=>$transaksi, 'order_receipt' => $order_receipt, "orderedBy" => $orderedBy, "lastIDorder" =>   $lastIDorder]);
    }

    public function edit($id){
            $transaksi = Transaksi::with("bookingdetail")->get();
            $datatrans = Transaksi::with('bookingdetail');
            $datatransaksi = Transaksi::find($id);
            return view("riwayatPenjualan.index", ["transaksi"=>$transaksi,"datatrans" => $datatrans, "datatransaksi" => $datatransaksi]);
    
    }

    public function update(Request $request, $id)
    {
        $datatransaksi = Transaksi::find($id)->update($request->all());
        return redirect('riwayatpenjualan')->with('success', 'Task Created Successfully!');
    }


    public function searchfromDate(Request $req)
    {
        $datefrom = $req->datefrom;
        $dateto = $req->dateto;
    	$transaksi = Transaksi::with("bookingdetail")
        ->whereBetween('transaksi_date',[$datefrom,$dateto])
        ->orWhere('transaksi_date', $datefrom)
        ->orWhere('transaksi_date', $dateto)->get();
        return view("riwayatPenjualan.index", ["transaksi" => $transaksi]);
    }
}

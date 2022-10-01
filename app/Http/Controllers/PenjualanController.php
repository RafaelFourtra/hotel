<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kamar;
use App\Models\Transaksi;
use App\Models\BookingDetail;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    public function home(){
        
    }
    public function index(){
        $kamars = Kamar::all();
        $orders = Transaksi::all();
        $lastID = BookingDetail::max('id_transaksi');
        $lastIDorder = Transaksi::orderBy("id", 'desc')->first();
        $order_receipt = BookingDetail::with("kamar")->where('id_transaksi', $lastID)->get();
        $orderedBy = Transaksi::where('id', $lastID)->get();

        return view('penjualan.index', ['kamars' => $kamars, 'orders' => $orders, 
        'order_receipt' => $order_receipt, "orderedBy" => $orderedBy, "lastIDorder" =>   $lastIDorder]);
      
    }

    public function store(Request $request)
    {
        //inisialisasi
        $kamars;
        $booking_detail;
        

        
        $result =  DB::transaction(function () use(&$request){
            $transaksi_jumlah=0;

            $no = Transaksi::whereDate('transaksi_date', Carbon::today())->count();
            $no ++;
            $no_nota = date('ymd').str_pad($no,3,0,STR_PAD_LEFT);
            $transaksi = new Transaksi();
            $transaksi->nama = $request->customer_name;
            $transaksi->addres = $request->customer_addres;
            $transaksi->contact = $request->customer_contact;
            $transaksi->check_in = $request->check_in;
            $transaksi->check_out = $request->check_out;
            $transaksi->no_nota = $no_nota;
            $transaksi->user_id = auth()->user()->id;
            $transaksi->returning_charge = $request->returning_charge;
            $transaksi->payment = $request->payment;
            $transaksi->payment_method = $request->payment_method;
            $transaksi->transaksi_date = date('Y-m-d');
            

            for ($id_kamar = 0; $id_kamar < count($request->id_kamar); $id_kamar++){
            $booking_detail = new BookingDetail;      
            $booking_detail->id_kamar = $request->id_kamar[$id_kamar];
            $booking_detail->day = $request->day[ $id_kamar];
            $booking_detail->harga = $request->harga[ $id_kamar];
            $booking_detail->total_harga = $request->total_harga[ $id_kamar];
            $transaksi_jumlah +=$request->total_harga[ $id_kamar];
            
        
            $transaksi->transaksi_jumlah = $transaksi_jumlah;
            $transaksi->save();
            $id_transaksi = $transaksi->id;
            $booking_detail->id_transaksi = $id_transaksi;
            $booking_detail->save();
            }
            
            

            $kamars = Kamar::all();   
            $booking_detail = BookingDetail::where('id_transaksi', $id_transaksi)->get();
            $orderedBy = Transaksi::where('id')->get();
            $lastIDorder = Transaksi::orderBy("id", 'desc')->first();


            return [
                'kamars' => $kamars,
                'booking_detail' => $booking_detail,
                'orderedBy' => $orderedBy,
                'lastIDorder' => $lastIDorder,
                
            ];
            
        });

        return view("penjualan.index", $result )->with('success', 'Task Created Successfully!');   
    }

}


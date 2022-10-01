<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Excel;
use App\Exports\LaporanHarianExport;
use App\Exports\LaporanBulananExport;

class LaporanController extends Controller
{
    public function index(Request $req) 
    {
        $data = Transaksi::with("bookingdetail");
        if($req->filled('datefrom')){
            $datefrom = $req->datefrom;
            $dateto = $req->dateto;
            $data
            ->whereBetween('transaksi_date',[$datefrom,$dateto])
            ->orWhere('transaksi_date', $datefrom)
            ->orWhere('transaksi_date', $dateto);
            return view('laporan.index',["data" => $data->get(), 'datefrom' => $datefrom , 'dateto' => $dateto]);
        }
        return view('laporan.index',["data" => $data->get()]);
    }


    public function getBulanan($start,$end){
        $data = Transaksi::with("bookingdetail");

        $datanewstructure = [];
       
        $olddata;
        if($start !== "-" and $end !== "-"){
            $datefrom = $start;
            $dateto = $end;
            $data
            ->whereBetween('transaksi_date',[$datefrom,$dateto])
            ->orWhere('transaksi_date', $datefrom)
            ->orWhere('transaksi_date', $dateto);
          
        }

        $data = $data->groupBy("transaksi_date")->get();
        //mengisi data struktur yg baru

        foreach($data as $i => $dato){
            $datanewstructure[$i]["tanggal"] = $dato->transaksi_date;
            $datanewstructure[$i]["cash"] = Transaksi::where("transaksi_date",$dato->transaksi_date)->where("payment_method", "Cash")->sum("transaksi_jumlah") > 0 ? Transaksi::where("transaksi_date",$dato->transaksi_date)->where("payment_method", "Cash")->sum("transaksi_jumlah") : null;
            $datanewstructure[$i]["reddoorz"] = Transaksi::where("transaksi_date",$dato->transaksi_date)->where("payment_method", "Red Doorz")->sum("transaksi_jumlah") > 0 ? Transaksi::where("transaksi_date",$dato->transaksi_date)->where("payment_method", "Red Doorz")->sum("transaksi_jumlah"): null;
            $datanewstructure[$i]["total"] = Transaksi::where("transaksi_date",$dato->transaksi_date)->whereNotIn("payment_method" ,['Piutang', 'cancel'])->sum("transaksi_jumlah");
        }

        $arrayr = ["data" => $datanewstructure];
        $arrayr["datefrom"] = $start;
        $arrayr["dateto"] = $end;

       return $arrayr;
    }
    
    public function bulanan(Request $req) 
    {
        $datefrom = "-";
        $dateto = "-";
        if($req->filled("datefrom") and  $req->filled("dateto")){
            $datefrom = $req-> datefrom == '-' ? null : $req-> datefrom;
            $dateto = $req-> dateto == '-' ? null : $req-> dateto;
        }
       
        $arrayr = $this->getBulanan($datefrom,$dateto);
        

     
        return view('laporan.bulanan',$arrayr);
    }

  
    public function export(Request $req)
    {
        $datefrom = $req-> datefrom == '-' ? null : $req-> datefrom;
        $dateto = $req-> dateto == '-' ? null : $req-> dateto;
        
        return Excel::download(new LaporanHarianExport($datefrom,$dateto),"Laporan Harian.xls");
    }
  
    public function exportbulanan(Request $req)
    {
        $datefrom = $req-> datefrom;
        $dateto = $req->dateto;

        $laporanBulanan = $this->getBulanan($datefrom,$dateto);

        //dd($laporanBulanan);
        
        return Excel::download(new LaporanBulananExport($laporanBulanan),"Laporan Bulanan.xls");
    }
  
}

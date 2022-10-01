<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LaporanBulananExport implements FromView
{
    public $lp;
   

    public function __construct($lapbu)
    {
        $this->lp = $lapbu;
    }
    public function view(): View
    {
            
        return view('laporan.reportsbulanan', $this->lp);
    }

}

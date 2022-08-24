<?php

namespace App\Exports;

use App\Model\JurnalPembelian;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class JPembelianExport implements FromView, ShouldAutoSize, WithStrictNullComparison
{
    protected $start, $end;

    function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $pembelian = JurnalPembelian::whereBetween('trans_date', [$this->start, $this->end])->get();
        return view('jurnal.jurnal_pembelian_excel', [
            'data_pembelian' => $pembelian,
            // 'date_inv' => $date_inv,
            // 'inv_fix' => $inv_fix,
        ]);
    }
}

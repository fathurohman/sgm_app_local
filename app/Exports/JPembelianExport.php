<?php

namespace App\Exports;

use App\Model\JurnalPembelian;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithTitle;

class JPembelianExport implements FromView, ShouldAutoSize, WithStrictNullComparison, WithTitle
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

    public function title(): string
    {
        return 'Jur_Pembelian';
    }
}

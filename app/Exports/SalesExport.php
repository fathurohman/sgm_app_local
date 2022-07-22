<?php

namespace App\Exports;

use App\Model\reports;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class SalesExport implements FromView, ShouldAutoSize, WithStrictNullComparison
{
    protected $month;

    function __construct($month)
    {
        $this->month = $month;
    }

    public function view(): View
    {
        $year = Carbon::now()->format('Y');
        $bulan = $this->month;
        $reports = reports::all();
        // foreach ($reports as $x) {
        //     $ptng = sprintf('%03d', $x->no_inv);
        //     $sub_string = substr($x->no_inv, strpos($x->no_inv, "/") + 1);
        //     $inv_fix = "$ptng/$sub_string";
        // }
        return view('reports.monthly', [
            'reports' => $reports,
            'bulan' => $bulan,
            'tahun' => $year,
            // 'inv_fix' => $inv_fix,
        ]);
    }
}

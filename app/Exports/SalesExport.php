<?php

namespace App\Exports;

use App\Model\reports;
use Carbon\Carbon;
use DateTime;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class SalesExport implements FromView, ShouldAutoSize, WithStrictNullComparison
{
    protected $month, $month2, $years;

    function __construct($month, $month2, $years)
    {
        $this->month = $month;
        $this->month2 = $month2;
        $this->years = $years;
    }

    public function view(): View
    {
        // $year = Carbon::now()->format('Y');
        $year = $this->years;
        $bulan = $this->month;
        $dateObj   = DateTime::createFromFormat('!m', $bulan);
        $monthName = $dateObj->format('F'); // March

        $bulan2 = $this->month2;
        $dateObj2   = DateTime::createFromFormat('!m', $bulan2);
        $monthName2 = $dateObj2->format('F'); // March

        $reports = reports::all();
        // foreach ($reports as $x) {
        //     $ptng = sprintf('%03d', $x->no_inv);
        //     $sub_string = substr($x->no_inv, strpos($x->no_inv, "/") + 1);
        //     $inv_fix = "$ptng/$sub_string";
        // }
        return view('reports.monthly', [
            'reports' => $reports,
            'bulan' => $monthName,
            'bulan2' => $monthName2,
            'tahun' => $year,
            // 'inv_fix' => $inv_fix,
        ]);
    }
}

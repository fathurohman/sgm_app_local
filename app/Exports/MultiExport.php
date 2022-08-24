<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiExport implements WithMultipleSheets
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
    public function sheets(): array
    {
        return [
            new JPembelianExport($this->start, $this->end),
            // new JPenjualanExport($this->start, $this->end),
        ];
    }
}

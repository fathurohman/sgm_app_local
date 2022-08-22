<?php

namespace App\Exports;

use App\Model\SalesOrder;
use Maatwebsite\Excel\Concerns\FromCollection;

class JPembelianExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SalesOrder::all();
    }
}

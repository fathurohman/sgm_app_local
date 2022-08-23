<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JurnalPenjualan extends Model
{
    protected $table = 'jurnal_penjualan';

    public function coa()
    {
        return $this->belongsTo('App\Model\COA', 'coa_id');
    }
}

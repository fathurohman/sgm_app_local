<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JurnalPembelian extends Model
{
    protected $table = 'jurnal_pembelian';

    public function coa()
    {
        return $this->belongsTo('App\Model\COA', 'coa_id');
    }

    public function job_orders()
    {
        return $this->belongsTo('App\Model\job_order', 'job_order_id');
    }
}

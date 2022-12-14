<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class job_order extends Model
{
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

    public function clients()
    {
        return $this->belongsTo('App\Model\Client', 'client_id');
    }

    public function sales()
    {
        return $this->belongsTo('App\User', 'sales_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Model\Service', 'service_id');
    }

    public function via()
    {
        return $this->belongsTo('App\Model\Via', 'via_id');
    }
}

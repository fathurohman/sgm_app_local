<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    public function job_orders()
    {
        return $this->belongsTo('App\Model\job_order', 'job_order_id');
    }

    public function sellings()
    {
        return $this->hasMany('App\Model\SellingOrder', 'sales_order_id');
    }

    public function buyings()
    {
        return $this->hasMany('App\Model\BuyingOrder', 'sales_order_id');
    }

    public function profits()
    {
        return $this->hasMany('App\Model\Profit', 'sales_order_id');
    }
}

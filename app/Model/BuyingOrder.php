<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BuyingOrder extends Model
{
    protected $fillable = [
        'sales_order_id', 'description', 'qty', 'curr', 'price', 'sub_total', 'remark', 'name'
    ];
    protected $table = 'buying_orders';
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellingOrder extends Model
{
    protected $table = 'selling_orders';
    protected $fillable = [
        'sales_order_id', 'description', 'qty', 'curr', 'price', 'sub_total', 'remark', 'name'
    ];
}

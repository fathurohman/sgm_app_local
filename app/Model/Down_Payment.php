<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Down_Payment extends Model
{
    protected $fillable = [
        'sales_order_id', 'customer', 'currency', 'total', 'dp'
    ];
    protected $table = 'down_payments';
}

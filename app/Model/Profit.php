<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    protected $fillable = [
        'sales_order_id', 'currency', 'total_selling', 'total_buying', 'profit'
    ];
    protected $table = 'profits';
}

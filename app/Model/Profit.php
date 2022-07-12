<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profit extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'sales_order_id', 'currency', 'total_selling', 'total_buying', 'profit'
    ];
    protected $table = 'profits';
}

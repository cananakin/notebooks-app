<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = [
        'buy_order_id',
        'sell_order_id',
        'instrument_id',
        'price',
        'qty',
        'price',
        'traded_at',
    ];
}

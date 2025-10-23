<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Trade;
use Illuminate\Support\Facades\DB;

class MatchingService
{
    public function tryMatch(Order $incoming): ?Trade
    {
        return DB::transaction(function () use ($incoming) {
            $q = Order::where('instrument_id', $incoming->instrument_id)
                ->where('status', 'open')
                ->where('side', $incoming->side === 'buy' ? 'sell' : 'buy')
                ->when($incoming->type === 'limit', function ($q) use ($incoming) {
                    return $incoming->side === 'buy'
                        ? $q->whereNotNull('price')->where('price', '<=', $incoming->price)
                        : $q->whereNotNull('price')->where('price', '>=', $incoming->price);
                })
                ->orderBy('created_at')   // FIFO
                ->lockForUpdate()
                ->first();

            if (!$q) return null;

            $qty   = min($incoming->qty, $q->qty);
            $price = $q->price ?? $incoming->price ?? 0;

            $trade = Trade::create([
                'buy_order_id'  => $incoming->side === 'buy' ? $incoming->id : $q->id,
                'sell_order_id' => $incoming->side === 'sell' ? $incoming->id : $q->id,
                'instrument_id' => $incoming->instrument_id,
                'price' => $price,
                'qty'   => $qty,
                'traded_at' => now(),
            ]);

            foreach ([$incoming, $q] as $o) {
                $o->qty -= $qty;
                if ($o->qty === 0) $o->status = 'filled';
                $o->save();
            }

            $incoming->instrument()->update(['last_price' => $price]);

            return $trade;
        });
    }
}

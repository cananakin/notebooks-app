<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\{Instrument, Order, User};
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class)->in('Feature','Unit');

it('creates buy order and matches existing sell', function () {
    $user = User::factory()->create();
    $ins  = Instrument::first() ?? Instrument::factory()->create();
    actingAs($user);

    Order::create([
      'user_id'=>$user->id,'instrument_id'=>$ins->id,
      'side'=>'sell','type'=>'limit','qty'=>5,'price'=>120,'status'=>'open'
    ]);

    $res = $this->postJson('/api/orders', [
      'instrument_id'=>$ins->id,'side'=>'buy','type'=>'limit','qty'=>3,'price'=>125
    ])->assertCreated()->json();

    expect($res['trade'])->not()->toBeNull()
      ->and($res['trade']['qty'])->toBe(3);
});

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstrumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Instrument::insert([
            ['sku'=>'BI-CHX-2015','name'=>'Chateau X 2015','region'=>'Bordeaux','vintage'=>2015,'tick_size'=>0.50,'created_at'=>now(),'updated_at'=>now()],
            ['sku'=>'BI-CHY-2018','name'=>'Chateau Y 2018','region'=>'Bordeaux','vintage'=>2018,'tick_size'=>1.00,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}

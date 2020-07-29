<?php

use Illuminate\Database\Seeder;

class SymbolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \Illuminate\Support\Facades\DB::table('symbol')->insert([
            [
                'from' => "usd",
                'to' => "try",
            ], [
                'from' => "eur",
                'to' => "try",
            ], [
                'from' => "gbp",
                'to' => "try",
            ]
        ]);
    }
}

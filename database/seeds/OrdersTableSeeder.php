<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'customer_id' => 1,
            'order_status_id' => 1,
            'event_id' => 1,
            'created_at' => now(),
            'reference' => Str::uuid()
        ]);
        DB::table('orders')->insert([
            'customer_id' => 1,
            'order_status_id' => 1,
            'event_id' => 1,
            'created_at' => now(),
            'reference' => Str::uuid()
        ]);
        DB::table('orders')->insert([
            'customer_id' => 2,
            'order_status_id' => 1,
            'event_id' => 1,
            'created_at' => now(),
            'reference' => Str::uuid()
        ]);
        DB::table('orders')->insert([
            'customer_id' => 3,
            'order_status_id' => 1,
            'event_id' => 2,
            'created_at' => now(),
            'reference' => Str::uuid()
        ]);
        DB::table('orders')->insert([
            'customer_id' => 4,
            'order_status_id' => 1,
            'event_id' => 2,
            'created_at' => now(),
            'reference' => Str::uuid()
        ]);
    }
}

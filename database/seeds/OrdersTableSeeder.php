<?php

use Illuminate\Database\Seeder;

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
            'order_status_id' => 1
        ]);
        DB::table('orders')->insert([
            'customer_id' => 1,
            'order_status_id' => 1
        ]);
        DB::table('orders')->insert([
            'customer_id' => 2,
            'order_status_id' => 1
        ]);
    }
}

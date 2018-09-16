<?php

use Illuminate\Database\Seeder;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_details')->insert([
            'ticket_id' => 1,
            'customer_id' => 1,
            'event_id' => 1,
            'price' => 10.00,
            'order_id' => 1,
            'code' => '12345'
        ]);
        DB::table('order_details')->insert([
            'ticket_id' => 1,
            'event_id' => 1,
            'price' => 10.00,
            'order_id' => 1,
            'code' => '12344'
        ]);
        DB::table('order_details')->insert([
            'ticket_id' => 2,
            'event_id' => 1,
            'customer_id' => 1,
            'price' => 120.00,
            'order_id' => 1,
            'code' => '12342'
        ]);
    }
}

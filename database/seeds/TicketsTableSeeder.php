<?php

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tickets')->insert([
            'title' => 'ticket1',
            'description' => 'description',
            'price' => 10.00,
            'max_per_person' => 1,
            'min_per_person' => 1,
            'quantity_available' => 50,
            'quantity_sold' => 50,
            'start_sale_date' => now(),
            'end_sale_date' => now(),
            'event_id' => 1,
            'created_by' => 1

        ]);
        DB::table('tickets')->insert([
            'title' => 'ticket2',
            'description' => 'description',
            'price' => 120.00,
            'max_per_person' => 1,
            'min_per_person' => 1,
            'quantity_available' => 50,
            'quantity_sold' => 50,
            'start_sale_date' => now(),
            'end_sale_date' => now(),
            'event_id' => 1,
            'created_by' => 1
        ]);
    }
}

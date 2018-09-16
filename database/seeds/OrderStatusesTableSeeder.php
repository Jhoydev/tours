<?php

use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert([
            'name' => 'Pago'
        ]);
        DB::table('order_statuses')->insert([
            'name' => 'Pendiente'
        ]);
        DB::table('order_statuses')->insert([
            'name' => 'Cancelado'
        ]);
        DB::table('order_statuses')->insert([
            'name' => 'Reembolsado'
        ]);
    }
}

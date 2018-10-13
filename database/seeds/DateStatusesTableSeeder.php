<?php

use Illuminate\Database\Seeder;

class DateStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('date_statuses')->insert([
            'name' => 'Confirmada'
        ]);
        DB::table('date_statuses')->insert([
            'name' => 'Pendiente'
        ]);
        DB::table('date_statuses')->insert([
            'name' => 'Cancelada'
        ]);
    }
}

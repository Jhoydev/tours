<?php

use Illuminate\Database\Seeder;

class MeetingStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meeting_statuses')->insert([
            'name' => 'Confirmada'
        ]);
        DB::table('meeting_statuses')->insert([
            'name' => 'Pendiente'
        ]);
        DB::table('meeting_statuses')->insert([
            'name' => 'Cancelada'
        ]);
    }
}

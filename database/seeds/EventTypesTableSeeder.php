<?php

use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('eventos2')->table('event_types')->insert([
            'name' => 'ida y vuyelta'
        ]);
        DB::connection('eventos2')->table('event_types')->insert([
            'name' => 'solo ida'
        ]);
    }
}

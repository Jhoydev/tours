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

        DB::connection('eventos2')->table('event_status')->insert([
            'name' => 'on sale'
        ]);
        DB::connection('eventos2')->table('event_status')->insert([
            'name' => 'not on sale yet'
        ]);
        DB::connection('eventos2')->table('event_status')->insert([
            'name' => 'sales have ended'
        ]);
        DB::connection('eventos2')->table('event_status')->insert([
            'name' => 'sold out'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $item) {
            $end_date = $faker->dateTimeBetween($startDate = 'now', $endDate = '+60 days', $timezone = null);
            $start_date = $faker->dateTimeBetween($startDate = '- 60 days', $endDate = $end_date, $timezone = null);
            DB::connection('eventos2')->table('events')->insert([
                'title' => $faker->name,
                'description' => $faker->text,
                'location' => $faker->address,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'event_type_id' => 1,
                'created_by' => 1
            ]);
        }
    }
}

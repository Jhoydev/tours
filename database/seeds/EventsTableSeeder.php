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
            DB::table('events')->insert([
                'title' => $faker->name,
                'description' => $faker->text,
                'address' => $faker->address,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'country_id' => 47,
                'cp' => $faker->postcode,
                'pre_order_display_message' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'post_order_display_message' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'state_id' => 805,
                'city_id' => 48323,
                'event_type_id' => 1,
                'created_by' => 1,
                'company_id' => 1
            ]);
        }
        foreach (range(1, 10) as $item) {
            $end_date = $faker->dateTimeBetween($startDate = 'now', $endDate = '+60 days', $timezone = null);
            $start_date = $faker->dateTimeBetween($startDate = '- 60 days', $endDate = $end_date, $timezone = null);
            DB::table('events')->insert([
                'title' => $faker->name,
                'description' => $faker->text,
                'address' => $faker->address,
                'cp' => $faker->postcode,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'event_type_id' => 1,
                'country_id' => 47,
                'state_id' => 805,
                'city_id' => 48323,
                'created_by' => 3,
                'company_id' => 2
            ]);
        }
    }
}

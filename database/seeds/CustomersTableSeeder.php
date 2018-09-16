<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
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
            DB::table('customers')->insert([
                'first_name' => $faker->name,
                'last_name' => $faker->lastName,
                'document' => $item,
                'country_id' => 47,
                'state_id' => 805,
                'city_id' => 48323,
                'phone' => $faker->phoneNumber,
                'mobile' => $faker->phoneNumber,
                'address' => $faker->address,
                'zip_code' => $faker->postcode,
                'email' => "customer$item@email.com",
                'password' => bcrypt('123456')
            ]);
        }
    }
}

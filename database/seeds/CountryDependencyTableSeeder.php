<?php

use Illuminate\Database\Seeder;

class CountryDependencyTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Countries
        $path = 'database/sql/countries.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Countries table seeded!');

        // States
        $path = 'database/sql/states.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('States table seeded!');

        // Cities
        $path = 'database/sql/cities.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Cities table seeded!');
    }

}

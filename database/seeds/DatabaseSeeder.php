<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CompaniesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EventTypesTableSeeder::class);
        $this->call(CountryDependencyTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderDetailsTableSeeder::class);
        $this->call(MeetingStatusesTableSeeder::class);
    }
}

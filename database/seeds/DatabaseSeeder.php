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
        // $this->call(UsersTableSeeder::class

        $this->call(NodesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(AdminsTableSeeder::class);

        $this->call(CategorysTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        // $this->call(SpecsTableSeeder::class);

        // $this->call(StoresTableSeeder::class);
        // $this->call(EmployeesTableSeeder::class);

        // $this->call(MembersTableSeeder::class);
        // $this->call(CarsTableSeeder::class);

    }
}

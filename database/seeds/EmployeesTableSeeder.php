<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Store;
use App\Models\Employee;

class EmployeesTableSeeder extends Seeder
{
    public function run()
    {
        $store_ids = Store::query()->orderBy('id', 'desc')->limit(10)->pluck('id');
        $faker = app(Faker::class);

        $employees = factory(Employee::class)
            ->times(100)
            ->make()
            ->each(function ($employee, $index) use ($store_ids, $faker) {
                $employee->store_id = $faker->randomElement($store_ids);
            });

        foreach($employees as $employee) {
            $stores[$employee->store_id]['id'] = $employee->store_id;
            if(isset($stores[$employee->store_id]['employee_count'])) {
                $stores[$employee->store_id]['employee_count']++;
            } else {
                $stores[$employee->store_id]['employee_count'] = 0;
            }
        }

        foreach($stores as $store)
        {
            Store::find($store['id'])->update($store);
        }

        Employee::insert($employees->toArray());
    }

}


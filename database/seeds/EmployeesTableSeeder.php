<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Store;
use App\Models\Employee;

class EmployeesTableSeeder extends Seeder
{
    public function run()
    {
        $store_ids = Store::query()->limit(10)->pluck('id');
        $faker = app(Faker::class);

        $employees = factory(Employee::class)
            ->times(100)
            ->make()
            ->each(function ($employee, $index) use ($store_ids, $faker) {
                $employee->store_id = $faker->randomElement($store_ids);
            });

        foreach($employees as $employee) {
            $stores[$employee->store_id]['id'] = $employee->store_id;
        }


        foreach($stores as $store)
        {
            Store::find($store['id'])->update($store);
        }

        Employee::insert($employees->toArray());

        $employee = Employee::orderBy('id', 'desc')->first();
        $employee->name = '赵庆昌';
        $employee->type = 1;
        $employee->phone = '18638501517';
        $employee->superior_id = 99;
        $employee->save();

        $demoEmployeeId = $employee->id;

        $employees = Employee::limit(10)->get();
        foreach($employees as $employee) {
            $employee->superior_id = $demoEmployeeId;
            $employee->save();
        }
    }

}


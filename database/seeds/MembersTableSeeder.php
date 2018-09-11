<?php

use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\Employee;
use Faker\Generator as Faker;

class MembersTableSeeder extends Seeder
{
    public function run()
    {
        $employee_ids = Employee::orderBy('id', 'desc')->limit('20')->pluck('id');
        $faker = app(Faker::class);

        $members = factory(Member::class)
            ->times(200)
            ->make()
            ->each(function ($member, $index) use ($faker, $employee_ids) {
                $member->employee_id = $faker->randomElement($employee_ids);
                $member->letter = strtoupper(substr(pinyin_abbr($member->name), 0, 1));
            });

        Member::insert($members->toArray());
    }

}


<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\City;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $cities = City::all();

        foreach(range(1, 50) as $index) {
            Student::create([
                'vardas' => $faker->firstName,
                'pavarde' => $faker->lastName,
                'adresas' => $faker->streetAddress,
                'telefonas' => $faker->phoneNumber,
                'city_id' => $cities->random()->id,
            ]);
        }
    }
}
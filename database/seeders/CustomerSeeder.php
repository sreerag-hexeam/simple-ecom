<?php

namespace Database\Seeders;

use App\Models\Customer;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {

            Customer::create([
                'name' => $faker->name,
                'mobile' => $faker->phoneNumber,
            ]);

        }         
    }
}

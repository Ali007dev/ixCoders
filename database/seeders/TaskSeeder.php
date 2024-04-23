<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $numberOfRecords = 1000000; // Number of records you want to generate

        for ($i = 0; $i < $numberOfRecords; $i++) {
            DB::table('tasks')->insert([
                'name' => $faker->sentence,
                'file' => $faker->optional()->sentence,
                'comments' => $faker->boolean,
                'isOwner' => $faker->boolean,
                'priority' => $faker->randomElement(['1', '2', '3', '4']),
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }

}

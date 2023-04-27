<?php

namespace Database\Seeders;


use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;


class BookauthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->faker = Faker::create();

        $authors = [
            [
                'id' => 1,
                'first_name' => $this->faker->firstNameMale,
                'last_name' => $this->faker->lastName,
                'created_at' => Carbon::now(),
                'updated_at' => null
            ],
            [
                'id' => 2,
                'first_name' => $this->faker->firstNameFemale,
                'last_name' => $this->faker->lastName,
                'created_at' => Carbon::now(),
                'updated_at' => null
            ],
            [
                'id' => 3,
                'first_name' => $this->faker->firstNameMale,
                'last_name' => $this->faker->lastName,
                'created_at' => Carbon::now(),
                'updated_at' => null
            ],
            [
                'id' => 4,
                'first_name' => $this->faker->firstNameFemale,
                'last_name' => $this->faker->lastName,
                'created_at' => Carbon::now(),
                'updated_at' => null
            ],
            [
                'id' => 5,
                'first_name' => $this->faker->firstNameMale,
                'last_name' => $this->faker->lastName,
                'created_at' => Carbon::now(),
                'updated_at' => null
            ]

        ];

        DB::table('book_authors')->insert($authors);
    }
}

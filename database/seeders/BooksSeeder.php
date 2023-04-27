<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
/*
        $books = [
            [
                'id' => 1,
                'isbn' => $this->faker->numberBetween($min = 100000000000, $max = 999999999999),
                'isbn1' => $this->faker->numberBetween($min = 100000000000, $max = 999999999999),
                'book_category_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author2_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author3_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'publisher_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'book_type_id' => $this->faker->numberBetween($min = 1, $max = 2),
                'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'edition' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
                'format' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'weight' => $this->faker->numberBetween($min = 100, $max = 750),
                'price' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 2000),
                'currency' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
                'keywords' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'show' => 1,
                'backcover' => $this->faker->sentence($nbWords = 15, $variableNbWords = true),
                'shortdescription' => $this->faker->sentence($nbWords = 20, $variableNbWords = true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'isbn' => $this->faker->numberBetween($min = 100000000000, $max = 999999999999),
                'isbn1' => $this->faker->numberBetween($min = 100000000000, $max = 999999999999),
                'book_category_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author2_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author3_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'publisher_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'book_type_id' => $this->faker->numberBetween($min = 1, $max = 2),
                'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'edition' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
                'format' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'weight' => $this->faker->numberBetween($min = 100, $max = 750),
                'price' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 2000),
                'currency' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
                'keywords' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'show' => 1,
                'backcover' => $this->faker->sentence($nbWords = 15, $variableNbWords = true),
                'shortdescription' => $this->faker->sentence($nbWords = 20, $variableNbWords = true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'isbn' => $this->faker->numberBetween($min = 100000000000, $max = 999999999999),
                'isbn1' => $this->faker->numberBetween($min = 100000000000, $max = 999999999999),
                'book_category_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author2_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author3_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'publisher_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'book_type_id' => $this->faker->numberBetween($min = 1, $max = 2),
                'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'edition' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
                'format' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'weight' => $this->faker->numberBetween($min = 100, $max = 750),
                'price' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 2000),
                'currency' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
                'keywords' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'show' => 1,
                'backcover' => $this->faker->sentence($nbWords = 15, $variableNbWords = true),
                'shortdescription' => $this->faker->sentence($nbWords = 20, $variableNbWords = true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'isbn' => $this->faker->numberBetween($min = 100000000000, $max = 999999999999),
                'isbn1' => $this->faker->numberBetween($min = 100000000000, $max = 999999999999),
                'book_category_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author2_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author3_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'publisher_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'book_type_id' => $this->faker->numberBetween($min = 1, $max = 2),
                'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'edition' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
                'format' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'weight' => $this->faker->numberBetween($min = 100, $max = 750),
                'price' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 2000),
                'currency' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
                'keywords' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'show' => 1,
                'backcover' => $this->faker->sentence($nbWords = 15, $variableNbWords = true),
                'shortdescription' => $this->faker->sentence($nbWords = 20, $variableNbWords = true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'isbn' => $this->faker->numberBetween($min = 100000000000, $max = 999999999999),
                'isbn1' => $this->faker->numberBetween($min = 100000000000, $max = 999999999999),
                'book_category_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author2_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author3_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'publisher_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'book_type_id' => $this->faker->numberBetween($min = 1, $max = 2),
                'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'edition' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
                'format' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'weight' => $this->faker->numberBetween($min = 100, $max = 750),
                'price' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 2000),
                'currency' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
                'keywords' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'show' => 1,
                'backcover' => $this->faker->sentence($nbWords = 15, $variableNbWords = true),
                'shortdescription' => $this->faker->sentence($nbWords = 20, $variableNbWords = true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 6,
                'isbn' => $this->faker->numberBetween($min = 100000000000, $max = 999999999999),
                'isbn1' => $this->faker->numberBetween($min = 100000000000, $max = 999999999999),
                'book_category_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author2_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'author3_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'publisher_id' => $this->faker->numberBetween($min = 1, $max = 5),
                'book_type_id' => $this->faker->numberBetween($min = 1, $max = 2),
                'title' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'edition' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
                'format' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'weight' => $this->faker->numberBetween($min = 100, $max = 750),
                'price' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 2000),
                'currency' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
                'keywords' => $this->faker->sentence($nbWords = 3, $variableNbWords = true),
                'show' => 1,
                'backcover' => $this->faker->sentence($nbWords = 15, $variableNbWords = true),
                'shortdescription' => $this->faker->sentence($nbWords = 20, $variableNbWords = true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
                
        ];

        DB::table('books')->insert($books);
        */
    }
}

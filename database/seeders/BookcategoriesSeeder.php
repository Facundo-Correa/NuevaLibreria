<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BookcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();

        $categories = [
            [
                'id' => 1,
                'codigocat' => 1,
                'name' => 'Drama',
                'created_at' => Carbon::now(),
                'updated_at' => null
            ],
            [
                'id' => 2,
                'codigocat' => 2,
                'name' => 'Horror',
                'created_at' => Carbon::now(),
                'updated_at' => null
            ],
            [
                'id' => 3,
                'codigocat' => 3,
                'name' => 'Thriller',
                'created_at' => Carbon::now(),
                'updated_at' => null
            ],
            [
                'id' => 4,
                'codigocat' => 4,
                'name' => 'Filosofia',
                'created_at' => Carbon::now(),
                'updated_at' => null
            ],
            [
                'id' => 5,
                'codigocat' => 5,
                'name' => 'Biologia',
                'created_at' => Carbon::now(),
                'updated_at' => null
            ]

        ];

        DB::table('book_categories')->insert($categories);
    }
}

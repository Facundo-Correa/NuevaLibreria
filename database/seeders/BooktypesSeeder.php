<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BooktypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->faker = Faker::create();

        $types = [
            [
                'id' => 1,
                'name' => 'Fisico',
                'created_at' => Carbon::now(),
                'updated_at' => null
            ],
            [
                'id' => 2,
                'name' => 'Ebook',
                'created_at' => Carbon::now(),
                'updated_at' => null
            ]
        ];

        DB::table('book_types')->insert($types);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooklistssectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            [
                'id' => 1,
                'parent_id' => 0,
                'name' => 'promo',
                'label' => 'Promo',
            ],
            [
                'id' => 2,
                'parent_id' => 0,
                'name' => 'publicidad',
                'label' => 'Publicidad',
            ],
            [
                'id' => 3,
                'parent_id' => 0,
                'name' => 'carousel',
                'label' => 'Carousel',
            ],
            [
                'id' => 4,
                'parent_id' => 1,
                'name' => 'home',
                'label' => 'Home',
            ],
            [
                'id' => 5,
                'parent_id' => 1,
                'name' => 'ofertas',
                'label' => 'Ofertas',
            ],
            [
                'id' => 6,
                'parent_id' => 2,
                'name' => 'sidebar_left',
                'label' => 'Lateral izquierdo',
            ],
            [
                'id' => 7,
                'parent_id' => 2,
                'name' => 'sidebar_right',
                'label' => 'Lateral derecho',
            ],
            [
                'id' => 8,
                'parent_id' => 2,
                'name' => 'home_middle',
                'label' => 'Home medio',
            ],
            [
                'id' => 9,
                'parent_id' => 3,
                'name' => 'home_top',
                'label' => 'Home top',
            ],
            [
                'id' => 10,
                'parent_id' => 3,
                'name' => 'home_bottom',
                'label' => 'Home pie',
            ],
        ];

        DB::table('booklists_sections')->insert($sections);
    }
}

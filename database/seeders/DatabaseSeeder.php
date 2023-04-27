<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use TypiCMS\Modules\Booklists\Models\Booklistssections;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();
        $this->call(SettingsSeeder::class);
        $this->call(TranslationSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MenulinkSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(BookauthorsSeeder::class);
        $this->call(PublishersSeeder::class);
        $this->call(BookcategoriesSeeder::class);
        $this->call(BooktypesSeeder::class);
        $this->call(BooklistssectionsSeeder::class);
        Model::reguard();
    }
}

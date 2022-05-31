<?php

namespace Database\Seeders;

use Artisan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
	    $this->call(QuestionSetSeeder::class);
	    $this->call(BannerSeeder::class);
	    $this->call(OPDCategorySeeder::class);
        Artisan::call("passport:install");
    }
}

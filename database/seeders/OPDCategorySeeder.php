<?php

namespace Database\Seeders;

use DB;
use App\Models\OPDCategory;
use Illuminate\Database\Seeder;

class OPDCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Read JSON file
        $json = file_get_contents(__DIR__.'/../json/opd-categories.json');
        //Decode JSON
        $opd_category_payloads = json_decode($json,true);
		OPDCategory::insert($opd_category_payloads);
    }
}

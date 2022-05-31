<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DietChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Read JSON file
         $json = file_get_contents(__DIR__.'/../json/diet-chart.json');
         //Decode JSON
         $diet_charts = json_decode($json,true);
         foreach ($diet_charts as $diet_chart) {
            DB::table('diet_charts')->insert([
                 'chart' =>json_encode($diet_chart),
                 'diet_question_feedback_id' =>1,
                 'dietician_id' =>1,
                 'remarks' =>'remarks',
                 'valid_from' =>'2021-01-01',
                 'valid_upto' =>'2021-12-01',
             ]);
         }
    }
}

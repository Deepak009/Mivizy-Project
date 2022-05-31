<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class QuestionSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Read JSON file
        $json = file_get_contents(__DIR__.'/../json/question-sets.json');
        //Decode JSON
        $QuestionSets = json_decode($json,true);
        foreach ($QuestionSets as $QuestionSet) {
           DB::table('question_sets')->insert([
                'details' =>json_encode($QuestionSet),
            ]);
        }


    }
}

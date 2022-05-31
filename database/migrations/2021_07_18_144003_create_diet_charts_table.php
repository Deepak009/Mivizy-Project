<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietChartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diet_charts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diet_question_feedback_id');
            $table->unsignedBigInteger('dietician_id')->nullable();
            $table->text('remarks')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_upto')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('dietician_id')->references('id')->on('users');
            $table->foreign('diet_question_feedback_id')->references('id')->on('diet_question_feedbacks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diet_charts');
    }
}

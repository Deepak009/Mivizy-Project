<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietChartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diet_chart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diet_chart_id');
            $table->string('slot', 16);
            $table->tinyInteger('day_of_week');
            $table->foreignId('food_id');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('diet_chart_id')->on('diet_charts')->references('id')->onDelete('cascade');
            $table->foreign('food_id')->on('foods')->references('id')->onDelete('cascade');

            $table->unique(['diet_chart_id', 'slot', 'day_of_week', 'food_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diet_chart_items');
    }
}

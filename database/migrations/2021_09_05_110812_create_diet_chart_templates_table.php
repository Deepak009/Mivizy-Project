<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietChartTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diet_chart_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->unsignedBigInteger('dietician_id');
            $table->text('remarks')->nullable();
            $table->date('valid_from')->nullable();
            $table->date('valid_upto')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('dietician_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diet_chart_templates');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutinStartDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routin_start_days', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_section_id')->unsigned();
            $table->string('month');
            $table->date('start_date');
            $table->bigInteger('start_routin_day')->unsigned();
            $table->timestamps();

            $table->foreign('class_section_id')->references('id')->on('class_sections')->onDelete('cascade');
            $table->foreign('start_routin_day')->references('id')->on('routin_days')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routin_start_days');
    }
}

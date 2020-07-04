<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutinDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routin_days', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_section_id')->unsigned();
            $table->string('days');
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('class_section_id')->references('id')->on('class_sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routin_days');
    }
}

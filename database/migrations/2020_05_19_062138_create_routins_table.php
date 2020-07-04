<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('routin_day_id')->unsigned();
            $table->integer('period')->nullable();
            $table->string('subject')->nullable();
            $table->bigInteger('teacher_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('routin_day_id')->references('id')->on('routin_days')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routins');
    }
}

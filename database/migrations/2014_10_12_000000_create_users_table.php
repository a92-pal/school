<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_section_id')->nullable()->unsigned();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('reg_no')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_type',50)->default('student');
            $table->string('password');
            $table->integer('status')->default(1);
            // 0-> block, 1->active else-> passout
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

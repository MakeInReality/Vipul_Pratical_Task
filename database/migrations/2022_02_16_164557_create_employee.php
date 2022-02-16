<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id');
            $table->foreign('role_id')->references('id')->on('role');
            $table->string('name');
            $table->string('profile_pic');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->enum('gender',['Male','Female'])->nullable();
            $table->longText('address');
            $table->enum('status',['Active','Inactive'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}

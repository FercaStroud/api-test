<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('hbkey')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_birth');
            $table->string('address');
            $table->string('role');
            $table->string('password', 120);
            $table->string('mobile_phone')->nullable();
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

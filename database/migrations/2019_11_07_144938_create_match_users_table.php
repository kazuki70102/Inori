<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('driver_id');
            $table->unsignedInteger('rider_id');

            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rider_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_users');
    }
}

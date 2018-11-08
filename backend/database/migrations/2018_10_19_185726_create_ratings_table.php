<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_user_id')->nullable()->unsigned();
            $table->foreign('from_user_id')->references('id')->on('users');
            $table->integer('to_user_id')->nullable()->unsigned();
            $table->foreign('to_user_id')->references('id')->on('users');
            $table->integer('rate_value'); // adress tablo or json data
            $table->string('comment',200); // adress tablo or json data
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
        Schema::dropIfExists('ratings');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('req_user_id')->nullable()->unsigned();
            $table->foreign('req_user_id')->references('id')->on('users');

            $table->integer('res_user_id')->nullable()->unsigned();
            $table->foreign('res_user_id')->references('id')->on('users');

            $table->integer('luggage_id')->nullable()->unsigned();
            $table->foreign('luggage_id')->references('id')->on('luggage');

            $table->integer('trip_id')->nullable()->unsigned();
            $table->foreign('trip_id')->references('id')->on('trips');

            $table->boolean('agree')->default(false);
            $table->string('status',20)->nullable();

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
        Schema::dropIfExists('offers');
    }
}

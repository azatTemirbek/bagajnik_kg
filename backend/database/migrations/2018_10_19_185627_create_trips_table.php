<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carrier_id')->nullable()->unsigned();
            $table->foreign('carrier_id')->references('id')->on('users');
            $table->timestamp('start_dt')->useCurrent();
            $table->timestamp('end_dt');
            $table->string('from_lat');
            $table->string('from_lng');
            $table->string('from_formatted_address');
            $table->string('from_place_id');
            $table->string('to_lat');
            $table->string('to_lng');
            $table->string('to_formatted_address');
            $table->string('to_place_id');
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
        Schema::dropIfExists('trips');
    }
}

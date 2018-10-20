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
            $table->string('from',20); // adress tablo or json data
            $table->string('to',20); // adress tablo or json data
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLuggageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('luggage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->nullable()->unsigned();
            $table->foreign('owner_id')->references('id')->on('users');
                    // ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('taker_id')->nullable()->unsigned();
            $table->foreign('taker_id')->references('id')->on('users');
            $table->string('takerName',20)->nullable();
            $table->string('takerPhone1',20)->nullable();
            $table->string('takerPhone2',20)->nullable();
            $table->string('mass',20);
            $table->boolean('comertial')->default(false);
            $table->string('value',20)->nullable();
            $table->string('price',20)->nullable();
            $table->string('from',20); // adress tablo or json data
            $table->string('to',20); // adress tablo or json data
            $table->timestamp('start_dt');
            $table->timestamp('end_dt');

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
        Schema::dropIfExists('luggage');
    }
}

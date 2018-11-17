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
            $table->foreign('owner_id')->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('taker_id')->nullable()->unsigned();
            $table->foreign('taker_id')->references('id')->on('users');
            $table->string('takerName',20)->nullable();
            $table->string('takerPhone1',20)->nullable();
            $table->string('takerPhone2',20)->nullable();
            $table->integer('mass');
            $table->boolean('comertial')->default(false);
            $table->string('value',20)->nullable();
            $table->decimal('price',9,2)->default(0);
            $table->string('from_lat');
            $table->string('from_lng');
            $table->string('from_formatted_address');
            $table->string('from_place_id');
            $table->string('to_lat');
            $table->string('to_lng');
            $table->string('to_formatted_address');
            $table->string('to_place_id');
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

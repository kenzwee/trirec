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
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('trip_title');
            $table->date('trip_start');
            $table->date('trip_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}

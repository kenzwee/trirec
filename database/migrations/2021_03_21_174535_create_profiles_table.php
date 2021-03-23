<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('username')->nullable(false)->unique();
            $table->text('introduction')->nullable();
            $table->text('want_to_travel_world')->nullable();
            $table->text('traveled_world')->nullable();
            $table->text('want_to_travel_japan')->nullable();
            $table->text('traveled_japan')->nullable();           
            $table->string('image_path')->nullable();
            $table->rememberToken();            
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
        Schema::dropIfExists('profiles');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $database = config('tenant.connections.tenant.database');
        $sql = 'create database if not exists '.$database;
        DB::statement($sql);
        Schema::dropIfExists($database.'.examples');
        Schema::create($database.'.examples', 
          function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            //Contacts
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            //Address
            $table->string('postal_code')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->default('RJ')->nullable();
            $table->string('country')->default('Brasil')->nullable();

            
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
        $database = config('tenant.connections.tenant.database');
        Schema::dropIfExists($database.'.examples');
    }
}

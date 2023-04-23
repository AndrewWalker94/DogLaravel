<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PolymorphTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userables', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('userable_id');
            $table->string('userable_type');
        });

        Schema::create('parkables', function (Blueprint $table) {
            $table->integer('park_id');
            $table->integer('parkable_id');
            $table->string('parkable_type');
        });

        Schema::create('breedables', function (Blueprint $table) {
            $table->integer('breed_id');
            $table->integer('breedable_id');
            $table->string('breedable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

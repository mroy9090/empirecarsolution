<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsertVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insert_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('parking_number');
            $table->integer('category_id');
            $table->string('vehicle_company');
            $table->integer('registration_number');
            $table->string('owner_name');
            $table->integer('owner_company_number');
            $table->softDeletes();
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
        Schema::dropIfExists('insert_vehicles');
    }
}

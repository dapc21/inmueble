<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_facilities', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('property_id')->unsigned();
			$table->foreign('property_id')->references('id')->on('properties');
			$table->integer('facility_id')->unsigned();
			$table->foreign('facility_id')->references('id')->on('facilities');
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('properties_facilities');
    }
}

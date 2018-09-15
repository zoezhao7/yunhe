<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarBrandsTable extends Migration 
{
	public function up()
	{
		Schema::create('car_brands', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('car_brands');
	}
}

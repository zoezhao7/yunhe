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
            $table->string('letter')->default('')->content('拼音首字母');
            $table->string('image')->default('')->content('图标');
            $table->tinyInteger('is_hot')->default(0)->content('热门品牌');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('car_brands');
	}
}

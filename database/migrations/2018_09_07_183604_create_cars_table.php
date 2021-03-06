<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration 
{
	public function up()
	{
		Schema::create('cars', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->index()->default(0);
            $table->integer('brand_id')->default(0)->content('品牌id');
            $table->string('vehicles')->default('')->content('车型');
            $table->string('specs')->default('')->content('规格');
            $table->string('color')->default('')->content('色彩');
            $table->string('image')->default('')->content('照片');
            $table->date('production_date')->nullable()->content('出厂日期');
            $table->date('buy_date')->nullable()->content('购买日期');
            $table->string('plate_number')->default('')->content('车牌号');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('cars');
	}
}

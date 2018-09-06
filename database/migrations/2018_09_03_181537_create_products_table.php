<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration 
{
	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->index()->unsigned();
            $table->string('name')->index();
            $table->string('intro')->index();
            $table->text('content')->nullable()->content('产品详情');
            $table->string('image')->default('')->content('产品图');
            $table->integer('sales')->unsigned()->default(0)->content('销量');
            $table->tinyInteger('is_sale')->unsigned()->default(0)->content('在售状态');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('products');
	}
}

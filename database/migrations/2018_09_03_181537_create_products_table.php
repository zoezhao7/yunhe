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
            $table->string('intro')->index()->default('');
            $table->text('fit_brands')->nullable()->content('适配的品牌，json');
            $table->text('colors')->nullable()->content('色彩图,名称 json');
            $table->text('content')->nullable()->content('产品详情');
            $table->string('image')->default('')->content('产品图');
            $table->integer('sales')->unsigned()->default(0)->content('销量');
            $table->tinyInteger('is_sale')->unsigned()->default(0)->content('在售状态');
            $table->float('discount')->default(0)->content('折扣');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('products');
	}
}

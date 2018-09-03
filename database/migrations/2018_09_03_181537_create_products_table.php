<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration 
{
	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('intro')->index();
            $table->text('content')->nullable();
            $table->string('image')->default('');
            $table->integer('sales')->unsigned()->default(0);
            $table->tinyInteger('is_sale')->unsigned()->default(0);
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('products');
	}
}

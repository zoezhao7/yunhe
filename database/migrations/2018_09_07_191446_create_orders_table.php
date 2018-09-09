<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration 
{
	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->index();
            $table->integer('car_id')->index();
            $table->integer('product_id')->index();
            $table->integer('spec_id')->index();
            $table->text('parameters')->nullable();
            $table->float('price', 4, 2)->default(0);
            $table->float('discount', 2, 2)->default(0);
            $table->float('money', 4, 2);
            $table->datetime('dealt_at')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('orders');
	}
}

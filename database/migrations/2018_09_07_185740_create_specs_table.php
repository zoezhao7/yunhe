<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecsTable extends Migration 
{
	public function up()
	{
		Schema::create('specs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('number')->unique()->index();
            $table->integer('product_id')->index();
            $table->float('price', 4, 2);
            $table->float('discount', 2, 2);
            $table->text('content')->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('specs');
	}
}

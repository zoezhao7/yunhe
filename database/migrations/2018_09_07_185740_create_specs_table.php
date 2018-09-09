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
            $table->string('size')->default('')->content('尺寸');
            $table->float('price', 10, 2)->default(0);
            $table->float('discount', 5, 2)->default(0);
            $table->text('content')->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('specs');
	}
}

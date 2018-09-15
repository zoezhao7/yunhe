<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration 
{
	public function up()
	{
		Schema::create('stores', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('phone')->default('');
            $table->string('address')->default('');
            $table->tinyInteger('employee_count')->unsigned()->default(0);
            $table->tinyInteger('is_open')->unsigned()->default(1);
            $table->text('sale_rate')->content('佣金规则');
            $table->float('subordinate_rate')->default(0)->content('下线提成');
            $table->text('remark')->nullable()->content('备注');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('stores');
	}
}

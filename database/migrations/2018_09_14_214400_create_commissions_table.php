<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissionsTable extends Migration 
{
	public function up()
	{
		Schema::create('commissions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('month')->default('')->content('2018-09');
            $table->integer('employee_id')->unsigned()->index();
            $table->string('type')->default('')->content('order, subrodinate');
            $table->integer('subordinate_id')->default(0)->content('提成下线id');
            $table->integer('order_id')->default(0)->content('佣金订单id');
            $table->float('money', 10, 2)->default(0)->conteng('金额');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('commissions');
	}
}

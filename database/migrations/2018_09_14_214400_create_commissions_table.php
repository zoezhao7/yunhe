<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissionsTable extends Migration 
{
	public function up()
	{
		Schema::create('commissions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned()->index();
            $table->tinyInteger('type')->default(1)->content('1销售佣金2下线提成');
            $table->integer('suboardinate_id')->default(0)->content('提成下线id');
            $table->integer('order_id')->default(0)->content('佣金订单id');
            $table->float('money', 10, 2)->default(0)->conteng('金额');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('commissions');
	}
}

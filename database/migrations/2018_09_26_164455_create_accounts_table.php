<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration 
{
	public function up()
	{
		Schema::create('accounts', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->unsigned()->index();
            $table->integer('employee_id')->unsigned()->default(0)->content('操作员');
            $table->integer('order_id')->unsigned()->default(0)->content('销售订单ID绑定');
            $table->integer('stock_order_id')->unsigned()->default(0)->content('备货订单ID绑定');
            $table->tinyInteger('type')->unsigned()->default(1)->content('1收入2支出');
            $table->float('money', 10, 2)->content('金额');
            $table->string('channel')->default('')->content('销售/备货/行政采购/其它/...');
            $table->datetime('operated_at')->nullable()->content('发生时间');
            $table->text('remark')->nullable()->content('备注');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('accounts');
	}
}

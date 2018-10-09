<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockOrdersTable extends Migration 
{
	public function up()
	{
		Schema::create('stock_orders', function(Blueprint $table) {
            $table->increments('id');
            $table->string('idnumber')->unique()->content('备货订单编号');
            $table->integer('store_id')->unsigned()->index();
            $table->integer('employee_id')->unsigned()->index()->default(0);
            $table->integer('product_id')->unsigned()->index();
            $table->integer('spec_id')->unsigned()->index();
            $table->string('color')->default('');
            $table->integer('number')->unsigned()->content('进货数量');
            $table->text('remark')->nullable()->content('备注信息');
            $table->tinyInteger('status')->index()->default(0)->content('0待处理1备货中2已发货3已收货');
            $table->string('product_idnumber')->default('')->content('产品唯一编号');
            $table->string('delivery_number')->default('')->content('物流单号');
            $table->text('delivery_note')->nullable()->content('交货单');
            $table->datetime('receipted_at')->nullable()->content('接单时间');
            $table->datetime('delivered_at')->nullable()->content('发货时间');
            $table->datetime('received_at')->nullable()->content('收货时间');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('stock_orders');
	}
}

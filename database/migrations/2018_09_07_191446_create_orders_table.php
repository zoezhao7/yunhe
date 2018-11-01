<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration 
{
	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->string('idnumber')->index()->unqiue()->content('订单编号');
            $table->integer('employee_id')->index();
            $table->integer('member_id')->index();
            $table->integer('car_id')->index();
            $table->text('parameters')->nullable()->content('交易参数（颜色 json）');
            $table->float('price', 10, 2)->default(0)->content('市场价格');
            $table->float('discount', 3, 2)->default(0)->content('交易折扣');
            $table->float('money', 10, 2)->content('交易金额');
            $table->datetime('dealt_at')->nullable()->content('交易时间');
            $table->integer('number')->default(1)->content('商品数量（套）');
            $table->text('remark')->nullable()->content('备注');
            $table->integer('status')->default(0)->content('0待审核1审核通过2审核失败');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('orders');
	}
}

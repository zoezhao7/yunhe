<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinsTable extends Migration 
{
	public function up()
	{
		Schema::create('coins', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->index()->unsigned();
            $table->integer('employee_id')->default(0)->index()->unsigned();
            $table->integer('order_id')->default(0)->index()->unsigned();
            $table->tinyInteger('type')->default(0)->index()->unsigned()->content('操作类型');
            $table->integer('number')->content('变动数量');
            $table->integer('account_number')->unsigned()->content('账户余额');
            $table->string('remark')->content('备注');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('coins');
	}
}

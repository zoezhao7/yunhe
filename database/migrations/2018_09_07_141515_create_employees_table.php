<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration 
{
	public function up()
	{
		Schema::create('employees', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('superior_id')->index()->default(0)->content('上级id');
            $table->integer('store_id')->index()->unsigned()->default(0);
            $table->string('phone')->index();
            $table->string('name')->index();
            $table->string('letter')->index()->default('');
            $table->string('idnumber')->default('');
            $table->string('intro')->default('')->content('个人介绍');
            $table->string('avatar')->default('')->content('头像');
            $table->tinyInteger('star')->default(5)->content('星级');
            $table->tinyInteger('type')->unsigned()->default(2)->content('1店长2员工3渠道');
            $table->string('password')->default('');
            $table->string('api_token', 100)->index()->default('');
            $table->integer('notification_count')->unsigned()->default(0)->content('通知消息数');
            $table->tinyInteger('status')->unsigned()->default(1)->index()->content('1在职2离职');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('employees');
	}
}

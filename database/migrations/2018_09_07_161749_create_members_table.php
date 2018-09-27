<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration 
{
	public function up()
	{
		Schema::create('members', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('letter')->index()->default('姓名拼音首字母');
            $table->string('avatar')->default('')->content('头像url');
            $table->string('phone')->index()->default('');
            $table->integer('employee_id')->index()->unsigned();
            $table->integer('store_id')->index()->unsigned()->default(0);
            $table->string('idnumber')->default('')->content('身份账号');
            $table->string('address')->default('')->content('客户住址');
            $table->string('api_token', 100)->index()->default('');
            $table->integer('coin_count')->default(0)->content('积分总数');
            $table->integer('notification_count')->unsigned()->default(0)->content('通知消息数');
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->string('weixin_openid')->default('');
            $table->string('weixin_unionid')->default('');
            $table->text('remark')->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('members');
	}
}

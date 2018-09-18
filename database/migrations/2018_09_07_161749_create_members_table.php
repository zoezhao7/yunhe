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
            $table->string('letter')->index()->default('');
            $table->string('phone')->index()->default('');
            $table->integer('employee_id')->index()->unsigned();
            $table->integer('store_id')->index()->unsigned()->default(0);
            $table->string('idnumber')->default(0)->content('身份账号');
            $table->string('address')->default('')->content('客户住址');
            $table->string('api_token', 100)->index()->default('');
            $table->integer('notification_count')->unsigned()->default(0)->content('通知消息数');
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->text('remark')->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('members');
	}
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration 
{
	public function up()
	{
		Schema::create('employees', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('phone')->index();
            $table->integer('store_id')->index()->unsigned()->default(0);
            $table->tinyInteger('type')->unsigned()->default(2)->content('1店长2员工3渠道');
            $table->string('password');
            $table->string('idnumber')->default('');
            $table->string('intro')->default('')->content('个人介绍');
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('employees');
	}
}

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
            $table->string('phone')->index()->default('');
            $table->integer('employee_id')->index()->unsigned();
            $table->integer('store_id')->index()->unsigned()->default(0);
            $table->string('idnumber');
            $table->string('address')->default('');
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('members');
	}
}

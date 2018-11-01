<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemosTable extends Migration 
{
	public function up()
	{
		Schema::create('memos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned()->index();
            $table->integer('member_id')->default(0)->index()->unsigned();
            $table->tinyInteger('type')->default(0);
            $table->text('content')->nullable();
            $table->tinyInteger('status')->default(1)->index();
            $table->datetime('handled_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('memos');
	}
}

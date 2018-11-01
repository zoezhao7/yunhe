<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->default(0)->index();
            $table->integer('store_id')->default(0)->index();
            $table->integer('employee_id')->default(0)->index();
            $table->string('route', 100)->default('');
            $table->string('action', 100)->default('');
            $table->string('method', 100)->default('')->content('请求方法');
            $table->string('message')->default('');
            $table->text('input')->nullable();
            $table->string('ip')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operation_logs');
    }
}

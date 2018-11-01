<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeixinUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weixin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname');
            $table->string('openid');
            $table->string('unionid');
            $table->tinyInteger('sex')->unsigned();
            $table->string('province')->default('');
            $table->string('city')->default('');
            $table->string('country')->default('');
            $table->string('headimgurl')->default('');
            $table->string('privilege')->default('');
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
        Schema::dropIfExists('weixin_users');
    }
}

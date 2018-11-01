<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name', 100)->index();
            $table->string('password', 100);
            $table->string('real_name', 100)->default('');
            $table->string('phone', 100)->index()->default('');
            $table->string('email', 100)->default('');
            $table->string('role_ids')->default('')->content('角色清单');
            $table->string('remember_token', 100)->nullable();
            $table->integer('notification_count')->unsigned()->default(0)->content('通知消息数');
            $table->tinyInteger('sort')->default(0);
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
        Schema::dropIfExists('admins');
    }
}

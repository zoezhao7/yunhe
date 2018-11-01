<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('controller_name')->default('')->content('控制器显示名');
            $table->string('controller')->content('控制器');
            $table->string('action_name')->default('')->content('方法显示名');
            $table->string('action')->conteng('方法');
            $table->tinyInteger('sort')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('admin_nodes');
    }
}

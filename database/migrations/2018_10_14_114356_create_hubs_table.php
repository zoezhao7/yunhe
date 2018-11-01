<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn')->index()->unique()->content('sn码');
            $table->integer('spec_id')->unsigned()->index()->default(0)->content('产品型号id');
            $table->string('color')->default('')->content('轮毂色彩');
            $table->integer('stock_order_id')->unsigned()->index()->default(0)->content('备货订单id');
            $table->integer('stock_order_product_id')->unsigned()->index()->default(0)->content('备货订单产品id');
            $table->integer('order_id')->unsigned()->index()->default(0)->content('销售订单id');
            $table->integer('order_product_id')->unsigned()->index()->default(0)->content('销售订单产品id');
            $table->integer('store_id')->unsigned()->index()->default(0);
            $table->tinyInteger('status')->default(1)->content('1门店未接收2门店库存中2已售出');
            $table->dateTime('sold_at')->nullable()->content('售出时间');
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
        Schema::dropIfExists('hubs');
    }
}

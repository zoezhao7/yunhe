<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock_order_id')->index()->default(0);
            $table->integer('spec_id')->index();
            $table->integer('product_id')->index()->default(0);
            $table->integer('car_vehicle_id')->default(0);
            $table->string('color')->default('');
            $table->integer('number')->default(0);
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('stock_order_products');
    }
}

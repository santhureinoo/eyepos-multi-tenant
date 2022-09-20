<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('outlet_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('supplier_id')->nullable();
            $table->unsignedInteger('inventory_id')->nullable();
            $table->unsignedInteger('service_id')->nullable();
            $table->string('brand')->nullable();
            $table->string('category')->nullable();
            $table->string('custom')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('total')->nullable();
            $table->float('discount')->nullable();
            $table->float('gst')->nullable();
            $table->text('description')->nullable();

            $table->foreign('outlet_id')->references('id')->on('outlets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InventoryOrder extends Migration
{
    public function up()
    {
        Schema::create('inventory_order', function (Blueprint $table) {
            $table->integer('inventory_id');
            $table->integer('order_id');
            $table->unsignedBigInteger('outlet_id');

            $table->foreign('outlet_id')->references('id')->on('outlets');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_order');
    }
}

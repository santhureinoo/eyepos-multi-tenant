<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InventoryBrands extends Migration
{
    public function up()
    {
        Schema::create('inventory_brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('outlet_id');

            $table->string('name');

            $table->foreign('outlet_id')->references('id')->on('outlets');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_brands');
    }
}

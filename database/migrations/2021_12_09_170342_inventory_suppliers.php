<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InventorySuppliers extends Migration
{
    public function up()
    {
        Schema::create('inventory_suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('outlet_id');
            $table->string('name');
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('suburb')->nullable();
            $table->string('country')->nullable();

            $table->timestamps();

            $table->foreign('outlet_id')->references('id')->on('outlets');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_suppliers');
    }
}

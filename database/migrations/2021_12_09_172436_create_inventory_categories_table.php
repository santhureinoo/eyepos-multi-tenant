<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryCategoriesTable extends Migration
{
    public function up()
    {

        Schema::create('inventory_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('outlet_id');

            $table->string('name');

            $table->timestamps();

            $table->foreign('outlet_id')->references('id')->on('outlets');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_categories');
    }
}

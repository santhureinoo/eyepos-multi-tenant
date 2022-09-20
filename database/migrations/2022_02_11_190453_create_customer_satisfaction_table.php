<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerSatisfactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_satisfaction', function (Blueprint $table) {
            $table->id();
            $table->string('purpose');
            $table->string('procedure')->default('n/a');
            $table->string('satisfaction')->default('n/a');
            $table->string('recommend')->default('n/a');
            $table->string('visit')->default('n/a');
            $table->string('improvement')->default('n/a');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_satisfaction');
    }
}

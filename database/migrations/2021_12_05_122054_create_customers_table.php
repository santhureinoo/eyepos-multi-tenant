<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('outlet_id');
            $table->string('first_name');
            $table->string('last_name');

            $table->string('email')->unique();
            $table->string('phone')->nullable();

            $table->string('gender')->nullable();
            $table->date('dob')->nullable();

            $table->string('company_name')->nullable();
            $table->string('occupation')->nullable();
            $table->string('reference')->nullable();
            $table->string('insurance')->nullable();

            $table->boolean('consent_marketing')->default(false);
            $table->boolean('consent_notifications')->default(false);

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
        Schema::dropIfExists('customers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerIntakeQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_intake_questionnaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('outlet_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('age');
            $table->string('currently_wearing')->nullable();
            $table->string('conditions')->nullable();
            $table->string('history')->nullable();
            $table->string('last_change')->nullable();
            $table->boolean('issues_near')->nullable();
            $table->boolean('issues_far')->nullable();
            $table->string('other')->nullable();
            $table->string('consent')->nullable();
            $table->boolean('converted')->default(false);

            $table->timestamps();

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
        Schema::dropIfExists('customer_intake_questionnaires');
    }
}

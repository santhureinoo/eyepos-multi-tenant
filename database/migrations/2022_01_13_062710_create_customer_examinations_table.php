<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('visit_id')->nullable();
            $table->string('category')->default('checkup');
            $table->string('pupillary_reflex')->nullable();
            $table->string('eyelids')->nullable();
            $table->string('tear_film')->nullable();
            $table->string('conjunctiva')->nullable();
            $table->string('cornea')->nullable();
            $table->string('iris')->nullable();
            $table->string('crystalline_lens')->nullable();
            $table->string('retinal_blood_vessels')->nullable();
            $table->string('optic_nerve')->nullable();
            $table->string('macula')->nullable();
            $table->string('retina_posterior_pole')->nullable();
            $table->string('eye_pressure')->nullable();

            $table->boolean('rec_prescription')->default(false);
            $table->boolean('rec_referral')->default(false);
            $table->boolean('rec_reexamination')->default(false);
            $table->boolean('rec_myopia')->default(false);
            $table->boolean('rec_supplements')->default(false);
            $table->string('rec_other')->nullable();
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
        Schema::dropIfExists('customer_examinations');
    }
}

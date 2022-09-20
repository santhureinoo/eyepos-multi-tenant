<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('customer_id');
            $table->integer('left_sphere')->nullable();
            $table->integer('left_cyl')->nullable();
            $table->integer('left_axis')->default(1)->nullable();
            $table->string('left_visual_acuity')->nullable();
            $table->integer('left_pd')->nullable();
            $table->integer('left_add')->nullable();
            $table->integer('right_sphere')->nullable();
            $table->integer('right_cyl')->nullable();
            $table->integer('right_axis')->default(1)->nullable();
            $table->string('right_visual_acuity')->nullable();
            $table->integer('right_pd')->nullable();
            $table->integer('right_add')->nullable();
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
        Schema::dropIfExists('visions');
    }
}

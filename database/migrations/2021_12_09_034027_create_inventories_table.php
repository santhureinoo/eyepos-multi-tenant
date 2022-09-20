<?php

use App\Models\Outlet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('outlet_id');
            $table->string('category');
            $table->string('type')->nullable();
            $table->unsignedInteger('supplier_id');
            $table->unsignedInteger('brand_id');
            $table->string('model_number')->nullable();
            $table->string('description')->nullable();
            $table->string('prescription')->nullable();
            $table->string('base_curve')->nullable();
            $table->string('diameter')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('size')->nullable();
            $table->integer('index')->nullable();
            $table->string('material')->nullable();
            $table->string('color_frame')->nullable();
            $table->string('color_frame_code')->nullable();
            $table->string('color_lens')->nullable();
            $table->string('color_lens_code')->nullable();
            $table->string('shape')->nullable();
            $table->string('price_cost')->nullable();
            $table->string('price_selling')->nullable();
            $table->boolean('consignment')->nullable();
            $table->datetime('purchase_at')->nullable();
            $table->datetime('soldout_at')->nullable();

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
        Schema::dropIfExists('inventories');
    }
}

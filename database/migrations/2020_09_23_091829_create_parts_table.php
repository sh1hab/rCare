<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->bigInteger('compatible_brand_id');
            $table->string('parts_number');
            $table->string('parts_code');
            $table->string('full_code');
            $table->string('parts_name');
            $table->longText('details');
            $table->double('avg_price');
            $table->double('margin');
            $table->double('sales_price');
            $table->integer('warranty_id');
            $table->tinyInteger('status');
            $table->integer('create_by');
            $table->integer('update_by');
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
        Schema::dropIfExists('parts');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purchase_id');
            $table->bigInteger('parts_id');
            $table->integer('quantity');
            $table->float('unit_price');
            $table->float('total_price');
            $table->text('parts_note')->nullable();
            $table->dateTime('request_date');
            $table->tinyInteger('status')->default('1')->comment('1 = Pending, 2 = Approve, 3 = Cancel');
            $table->integer('create_by');
            $table->integer('update_by')->nullable();
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
        Schema::dropIfExists('purchase_details');
    }
}

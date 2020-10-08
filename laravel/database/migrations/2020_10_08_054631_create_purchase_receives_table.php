<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_receives', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id');
            $table->integer('purchase_details_id');
            $table->integer('parts_id');
            $table->integer('rcv_quantity');
            $table->integer('rcv_location_id');
            $table->text('receive_note')->nullable();
            $table->text('supplier_challan_no');
            $table->json('serial_ids');
            $table->dateTime('receive_date');
            $table->integer('received_by');
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
        Schema::dropIfExists('purchase_receives');
    }
}

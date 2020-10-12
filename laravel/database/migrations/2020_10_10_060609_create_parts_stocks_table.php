<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('parts_id');
            $table->tinyInteger('type')->comment('1 = Purchase, 2 = Sales, 3 = Interchange, 4 = purchase return');
            $table->integer('quantity');
            $table->integer('location_id');
            $table->integer('purchase_id')->nullable();
            $table->integer('purchase_details_id')->nullable();
            $table->integer('purchase_rcv_id')->nullable();
            $table->integer('sales_id')->nullable();
            $table->integer('sales_details_id')->nullable();
            $table->integer('interchange_id')->nullable();
            $table->integer('interchange_details_id')->nullable();
            $table->integer('claim_id')->nullable();
            $table->integer('credit_memo_id')->nullable();
            $table->integer('credit_memo_details_id')->nullable();
            $table->integer('purchase_return_id')->nullable();
            $table->integer('purchase_return_details_id')->nullable();
            $table->dateTime('entry_date');
            $table->dateTime('affect_date');
            $table->integer('entry_by');
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
        Schema::dropIfExists('parts_stocks');
    }
}

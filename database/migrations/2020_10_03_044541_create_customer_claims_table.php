<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_claims', function (Blueprint $table) {
            $table->id();
            $table->string('rcv_no');
            $table->string('rcv_no_1');
            $table->string('rcv_no_2');
            $table->integer('rcv_location_id');
            $table->integer('current_location_id');
            $table->tinyInteger('rcom')->default('1')->comment('1 = Yes, 0 = No');
            $table->string('inv_no');
            $table->dateTime('inv_date');
            $table->integer('customer_id');
            $table->integer('engineer_id');
            $table->integer('type_id');
            $table->string('product_old');
            $table->string('serial_old');
            $table->text('product_details')->nullable();
            $table->text('problem_details');
            $table->longText('remarks')->nullable();
            $table->dateTime('approx_date');
            $table->tinyInteger('status')->default('1')->comment('1 = Pending, 2 = Diagnosing, 3 = Testing, 4 = Ready, 5 = Delivered');
            $table->integer('received_by');
            $table->integer('checked_by');
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
        Schema::dropIfExists('customer_claims');
    }
}

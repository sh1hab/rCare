<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterchangeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interchange_details', function (Blueprint $table) {
            $table->id();
            $table->integer('interchange_id');
            $table->integer('parts_id');
            $table->integer('quantity');
            $table->integer('serial_ids')->nullable();
            $table->dateTime('request_date')->nullable();
            $table->integer('request_by')->nullable();
            $table->dateTime('accept_date')->nullable();
            $table->integer('accept_by')->nullable();
            $table->dateTime('confirm_date')->nullable();
            $table->integer('confirm_by')->nullable();
            $table->dateTime('void_date')->nullable();
            $table->integer('void_by')->nullable();
            $table->tinyInteger('status')->default('1')->comment('1 = Request, 2 = Accept, 3 = Confirm, 4 = Void');
            $table->tinyInteger('instant')->default('0')->comment('0 = No, 1 = Yes');
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
        Schema::dropIfExists('interchange_details');
    }
}

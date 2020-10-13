<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interchanges', function (Blueprint $table) {
            $table->id();
            $table->integer('ic_from');
            $table->integer('ic_to');
            $table->text('remarks')->nullable();
            $table->dateTime('request_date');
            $table->integer('request_by');
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
        Schema::dropIfExists('interchanges');
    }
}

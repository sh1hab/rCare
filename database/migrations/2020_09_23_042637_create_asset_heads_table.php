<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_heads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('asset_type_id')->unsigned();
            $table->foreign('asset_type_id')->references('id')->on('asset_types');
            $table->string('asset_head');
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
        Schema::dropIfExists('asset_heads');
    }
}

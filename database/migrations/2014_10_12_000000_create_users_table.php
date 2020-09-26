<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('contact_no');
            $table->string('rs_id');
            $table->integer('user_role_id');
            $table->integer('location_id');
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();
            $table->tinyInteger('status');
            $table->integer('create_by');
            $table->integer('update_by');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                array(
                    'name' => 'admin',
                    'username' => 'admin',
                    'designation' => 'MD',
                    'contact_no' => '01725454788',
                    'email' => 'admin@test.com',
                    'password' => '$2y$10$46Y2SPvnA.GIejLuevj5Q.x/oHV8.nAcv/pMNC6wWZ3Cjjq3iw9A2',
                    'user_role_id' => '1',
                    'rs_id' => 'rs968',
                    'location_id' => '1',
                    'status' => '1',
                    'create_by' => '1',
                    'update_by' => '1',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                )
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->string('picture')->nullable();
            $table->string('BTC')->nullable();
            $table->string('ETH')->nullable();
            $table->string('status')->default(0);
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('zip')->nullable();
            $table->string('XRP')->nullable();
            $table->integer('dest_tag')->nullable();
            $table->string('coin_address')->nullable();
            $table->string('eth_address')->nullable();
            $table->string('btc_address')->nullable();
            $table->integer('referral_by')->nullable();
            $table->string('device_token')->nullable();
            $table->string('ico_balance')->nullable();
            $table->string('ico_bonus')->nullable();
            $table->string('device_id')->nullable();
            $table->enum('device_type',array('android','ios'));
            $table->enum('login_by',array('manual','facebook','google'));
            $table->string('social_unique_id')->nullable();
            $table->tinyInteger('verified')->default(0);
            $table->string('email_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

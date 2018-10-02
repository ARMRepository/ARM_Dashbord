<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->string('ico');
            $table->string('ico_price');
            $table->string('price');
            $table->string('payment_mode');
            $table->string('bonus_point');
            $table->string('referal_code');
            $table->text('payment_id')->nullable();
            $table->string('promocode')->nullable();
            $table->enum('status', [
                    'pending',
                    'processing',
                    'failed',
                    'success',
                ])->default('pending');

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
        Schema::dropIfExists('transaction_histories');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('ico');
            $table->enum('via', [
                'PURCHASE',
                'BONUS',
                'REFERRAL',
                'PROMOCODE'
            ]);
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
        Schema::dropIfExists('passbooks');
    }
}

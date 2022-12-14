<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table
                ->bigIncrements('id');

            $table
                ->unsignedBigInteger('transaction_id');

            $table
                ->unsignedBigInteger('product_id');

            $table  
                ->string('product_name');

            $table
                ->timestamps();     

            $table
                ->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
}

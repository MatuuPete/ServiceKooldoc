<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('voucher_transactions'))
        {
            Schema::create('voucher_transactions', function (Blueprint $table) 
            {
                $table->id();
                $table->unsignedBigInteger('transaction_id')->nullable();
                $table->unsignedBigInteger('customer_id');
                $table->string('voucher_id')->nullable();
                $table->timestamps();

                $table->foreign('transaction_id')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('set null');
                $table->foreign('voucher_id')->references('id')->on('vouchers')->onUpdate('cascade')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher_transactions');
    }
};

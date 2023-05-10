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
        if(!Schema::hasTable('transactions'))
        {
            Schema::create('transactions', function (Blueprint $table) 
            {
                $table->id();
                $table->unsignedBigInteger('service_id')->nullable();
                $table->string('payment_method');
                $table->decimal('amount', 8, 2);
                $table->string('payment_proof')->nullable();
                $table->string('notes')->nullable();
                $table->date('transaction_date')->nullable();
                $table->string('transaction_status')->default('pending');
                $table->timestamps();

                $table->foreign('service_id')->references('id')->on('services')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('transactions');
    }
};

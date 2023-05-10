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
        if(!Schema::hasTable('vouchers'))
        {
            Schema::create('vouchers', function (Blueprint $table) 
            {
                $table->string('id', 6)->primary();
                $table->decimal('discount', 8, 2);
                $table->text('description')->nullable();
                $table->date('start_date');
                $table->date('end_date');
                $table->integer('usage_count');
                $table->string('voucher_status')->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('vouchers');
    }
};

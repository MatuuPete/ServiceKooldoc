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
        if(!Schema::hasTable('warranty_claims'))
        {
            Schema::create('warranty_claims', function (Blueprint $table) 
            {
                $table->id();
                $table->unsignedBigInteger('warranty_id')->nullable();
                $table->date('claim_date');
                $table->string('statement');
                $table->string('claim_status')->default('pending');
                $table->timestamps();

                $table->foreign('warranty_id')->references('id')->on('warranties')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('warranty_claims');
    }
};

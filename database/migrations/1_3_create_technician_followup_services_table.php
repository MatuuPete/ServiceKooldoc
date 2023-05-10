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
        if(!Schema::hasTable('technician_followup_services'))
        {
            Schema::create('technician_followup_services', function (Blueprint $table) 
            {
                $table->id();
                $table->unsignedBigInteger('technician_id')->nullable();
                $table->unsignedBigInteger('followup_service_id')->nullable();
                $table->timestamps();
                
                $table->foreign('technician_id')->references('id')->on('technicians')->on('users')->onUpdate('cascade')->onDelete('set null');
                $table->foreign('followup_service_id')->references('id')->on('followup_services')->on('users')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('technician_followup_services');
    }
};

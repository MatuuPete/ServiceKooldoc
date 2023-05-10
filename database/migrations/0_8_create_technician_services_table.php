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
        if(!Schema::hasTable('technician_services'))
        {
            Schema::create('technician_services', function (Blueprint $table) 
            {
                $table->id();
                $table->unsignedBigInteger('technician_id')->nullable();
                $table->unsignedBigInteger('service_id')->nullable();
                $table->timestamps();

                $table->foreign('technician_id')->references('id')->on('technicians')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('technician_services');
    }
};

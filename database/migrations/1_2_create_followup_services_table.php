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
        if(!Schema::hasTable('followup_services'))
        {
            Schema::create('followup_services', function (Blueprint $table) 
            {
                $table->id();
                $table->unsignedBigInteger('service_id')->nullable();
                $table->unsignedBigInteger('admin_id')->nullable();
                $table->string('reason');
                $table->date('followup_date')->nullable();
                $table->string('followup_time')->nullable();
                $table->string('followup_report')->nullable();
                $table->string('followup_status')->default('pending');
                $table->timestamps();

                $table->foreign('service_id')->references('id')->on('services')->onUpdate('cascade')->onDelete('set null');
                $table->foreign('admin_id')->references('id')->on('admins')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('followup_services');
    }
};

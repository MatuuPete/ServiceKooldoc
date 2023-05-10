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
        if(!Schema::hasTable('warranties'))
        {
            Schema::create('warranties', function (Blueprint $table) 
            {
                $table->id();
                $table->unsignedBigInteger('service_id')->nullable();
                $table->string('warranty_type');
                $table->integer('period');
                $table->date('start_date');
                $table->date('end_date');
                $table->string('warranty_status')->default('active');
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
        Schema::dropIfExists('warranties');
    }
};

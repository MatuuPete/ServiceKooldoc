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
        if(!Schema::hasTable('technician_inventories'))
        {
            Schema::create('technician_inventories', function (Blueprint $table) 
            {
                $table->id();
                $table->unsignedBigInteger('technician_id')->nullable();
                $table->unsignedBigInteger('inventory_id')->nullable();
                $table->integer('quantity');
                $table->date('borrowed_date');
                $table->date('returned_date')->nullable();
                $table->timestamps();

                $table->foreign('technician_id')->references('id')->on('technicians')->onUpdate('cascade')->onDelete('set null');
                $table->foreign('inventory_id')->references('id')->on('inventories')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('technician_inventories');
    }
};

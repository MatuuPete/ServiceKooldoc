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
        if(!Schema::hasTable('technicians'))
        {
            Schema::create('technicians', function (Blueprint $table) 
            {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('age');
                $table->string('experience');
                $table->string('specialties');
                $table->string('image')->nullable();
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('technicians');
    }
};

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
        if(!Schema::hasTable('customers'))
        {
            Schema::create('customers', function (Blueprint $table) 
            {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('address')->nullable();
                $table->string('barangay')->nullable();
                $table->string('city')->nullable();
                $table->string('province')->nullable();
                $table->string('zip_code')->nullable();
                $table->string('property_type')->nullable();
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
        Schema::dropIfExists('customers');
    }
};

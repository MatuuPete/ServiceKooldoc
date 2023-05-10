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
        if(!Schema::hasTable('cancels'))
        {
            Schema::create('cancels', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('service_id')->nullable();
                $table->string('why')->nullable();
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
        Schema::dropIfExists('cancels');
    }
};

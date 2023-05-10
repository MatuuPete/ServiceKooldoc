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
        if(!Schema::hasTable('services'))
        {
            Schema::create('services', function (Blueprint $table) 
            {
                $table->id();
                $table->unsignedBigInteger('customer_id')->nullable();
                $table->unsignedBigInteger('admin_id')->nullable();
                $table->string('book_type')->default('online');
                $table->string('service_type');
                $table->string('ac_type');
                $table->string('ac_brand');
                $table->string('ac_hp');
                $table->string('unit_type');
                $table->integer('no_unit');
                $table->string('description');
                $table->string('image')->nullable();
                $table->string('cooling');
                $table->string('mechanical_noise');
                $table->string('electric_connectivity');
                $table->date('service_date')->nullable();
                $table->string('service_time')->nullable();
                $table->decimal('service_price', 8, 2);
                $table->string('service_report')->nullable();
                $table->string('service_status')->default('checking');
                $table->timestamps();

                $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('services');
    }
};

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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();            
            $table->dateTime('date_hourly');
            $table->string('name_emitter');
            $table->string('NIT_emitter');
            $table->string('name_buyer');
            $table->string('NIT_buyer');
            $table->integer('before_IVA');
            $table->integer('IVA');
            $table->integer('total_value');
            $table->integer('quantity');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};

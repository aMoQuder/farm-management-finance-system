<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBoxDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_box_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cashable_id');
            $table->string('cashable_type');
            $table->integer('amount');
            $table->date('date');
            $table->string('description')->nullable();
            $table->string('receiver')->nullable();
            // إضافة فهارس لعلاقة polymorphic
            $table->index(['cashable_type', 'cashable_id']);
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
        Schema::dropIfExists('cash_box_details');
    }
}

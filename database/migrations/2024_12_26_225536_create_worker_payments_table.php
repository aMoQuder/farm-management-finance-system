<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paymentable_id');
            $table->string('paymentable_type');
            $table->integer('amount');
            $table->date('date');
            $table->string('receiver')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('cash_id')->nullable();
            $table->foreign('cash_id')->references('id')->on('cash_boxes')->onDelete('set null');

            // إضافة فهارس لعلاقة polymorphic
            $table->index(['paymentable_type', 'paymentable_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('worker_payments');
    }
}

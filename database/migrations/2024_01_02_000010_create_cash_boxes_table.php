<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_boxes', function (Blueprint $table) {
            $table->id();

            $table->integer('amount');
            $table->date('date');
            $table->string('description')->nullable();
            $table->string('source')->nullable();
            $table->string("status")->default("Deposit");
            $table->string('receiver')->nullable();

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('cash_boxes');
    }
}

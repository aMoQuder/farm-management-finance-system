<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expen_companies', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->date('date');
            $table->string('receiver')->nullable();
            $table->string('reason')->nullable();
            $table->unsignedBigInteger('cash_id')->nullable();
            $table->foreign('cash_id')->references('id')->on('cash_boxes')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expen_companies');
    }
}

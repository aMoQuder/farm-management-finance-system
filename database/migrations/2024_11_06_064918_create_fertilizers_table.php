<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFertilizersTable extends Migration
{

    public function up()
    {
        Schema::create('fertilizers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Fertilizerable_id');
            $table->string('Fertilizerable_type');
            $table->string('name');
            $table->integer('quantity'); // كمية السماد
            $table->enum("type_quantity",['لتر','شكارة','كيس','كرتونة','كيلو']);
            $table->date('acquired_date'); // تاريخ الحصول
            $table->unsignedBigInteger('land_id'); // الارض الحاصلة   على السماد
            $table->foreign('land_id')->references('id')->on('lands');
            $table->timestamps();
            $table->index(['Fertilizerable_id', 'Fertilizerable_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('fertilizers');
    }
}

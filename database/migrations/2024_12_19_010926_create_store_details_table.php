<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('store_details', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('Storeable_id');
            $table->string('Storeable_type');


            $table->string('getter_name'); // اسم الحاصل على المنتج من المخزن
            $table->integer('quantity'); // الكمية
            $table->date('get_date'); // تاريخ السحب
            $table->unsignedBigInteger('land_id'); // الارض الحاصلة على المنتج
            $table->unsignedBigInteger('crop_id'); // الزرع الحاصل عىل المنتج



            $table->foreign('land_id')->references('id')->on('lands');
            $table->foreign('crop_id')->references('id')->on('crops');
            $table->timestamps();
            $table->index(['Storeable_id', 'Storeable_type']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('store_details');
    }
}

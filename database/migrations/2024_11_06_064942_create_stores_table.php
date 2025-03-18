<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{

    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم المنتج
            $table->string('type_store'); // نوع المنتج
            $table->integer('quantity'); // الكمية
            $table->enum("type_quantity",['لتر','شكارة','متر','كرتونة','طن','كيلو','نفس المخزون']); //وحدة كمية لفهم عرض المخزن
            $table->date('store_date'); // تاريخ التخزين
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}

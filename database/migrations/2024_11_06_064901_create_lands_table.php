<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandsTable extends Migration
{
    public function up()
    {
        Schema::create('lands', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الأرض
            $table->integer('area'); // المساحة
            $table->timestamps();
            $table->unsignedBigInteger('supervisor_id'); // العامل المشرف على الأرض
            $table->unsignedBigInteger('supervisor_id')->default(0)->change(); // العامل المشرف على الأرض
        });
    }
    public function down()
    {
        Schema::dropIfExists('lands');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{

    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الموظف
            $table->string('job'); // اسم الموظف
            $table->integer('salary'); // المرتب الشهري
            $table->integer('days_worked')->default("0"); // عدد الأيام التي عملها في الشهر
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('workers');
    }
}

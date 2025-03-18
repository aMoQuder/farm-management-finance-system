<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineJobsTable extends Migration
{

    public function up()
    {
        Schema::create('machine_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('MachineJobable_id');
            $table->string('MachineJobable_type');
            $table->string('Work_name'); // نوع الشغل
            $table->string('Work_day'); // يوم الشغل
            $table->string('Count_hour'); // عدد ساعات الشغل
            $table->string('machine_name'); // اسم الآلة
            $table->unsignedBigInteger('driver_id'); // العامل الذي يقود الآلة
            $table->timestamps();
            $table->unsignedBigInteger('land_id'); // الارض الحاصلة على السماد
            $table->foreign('land_id')->references('id')->on('lands');
            $table->foreign('driver_id')->references('id')->on('workers');
            $table->index(['MachineJobable_id', 'MachineJobable_type']);

        });
    }


    public function down()
    {
        Schema::dropIfExists('machine_jobs');
    }
}

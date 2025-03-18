<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('worker_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('WorkerGroupable_id');
            $table->string('WorkerGroupable_type');
            $table->unsignedBigInteger('supervisor_id'); // المقاول المشرف على عربية العمال
            $table->unsignedInteger('worker_count'); // عدد العمال
            $table->integer('daily_wage'); // أجر العامل اليومي
            $table->date('work_date'); // تاريخ العمل
            $table->foreign('supervisor_id')->references('id')->on('workervisours');
            $table->string('work')->nullable();
            $table->unsignedBigInteger('Land_id'); // الارض الحاصلة   على السماد
            $table->foreign('Land_id')->references('id')->on('lands');
            $table->enum("type_work",['يومية','جامبو','شكارة','فدان'])->default("يومية");
            $table->index(['WorkerGroupable_id', 'WorkerGroupable_type']);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('worker_groups');
    }
}

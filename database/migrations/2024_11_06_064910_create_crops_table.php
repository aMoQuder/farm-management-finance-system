<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Landable_id');
            $table->string('Landable_type');
            $table->string('name');
            $table->string('seed_quantity'); // كمية التقاوي
            $table->integer('seed_price'); // سعر الكمية
            $table->date('seed_acquired_date'); // تاريخ الحصول على التقاوي
            $table->timestamps();
            // إضافة فهارس لعلاقة polymorphic
            $table->index(['Landable_id', 'Landable_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('crops');
    }
}

<?php
// database/migrations/xxxx_xx_xx_create_expense_details_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('expense_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expensable_id');
            $table->string('expensable_type');
            $table->unsignedBigInteger('cash_id')->nullable();
            $table->foreign('cash_id')->references('id')->on('cash_boxes')->onDelete('set null');
            $table->integer('amount');
            $table->date('date');
            $table->string('reason')->nullable();
            $table->timestamps();

            // إضافة فهارس لعلاقة polymorphic
            $table->index(['expensable_id', 'expensable_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('expense_details');
    }
}

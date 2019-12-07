<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
             $table->bigIncrements('Vid');
             $table->float('Amount',16,2);
             $table->string('AmountInWords');
             $table->biginteger('bid')->unsigned()->nullable();
             $table->foreign('bid')->references('bid')->on('brokers');
             $table->biginteger('iid')->unsigned()->nullable();
             $table->foreign('iid')->references('iid')->on('invoices');
             $table->biginteger('eid')->unsigned()->nullable();
             $table->foreign('eid')->references('eid')->on('employees');
             $table->biginteger('aid')->unsigned()->nullable();
             $table->string('employee_operation')->nullable();
             $table->foreign('aid')->references('aid')->on('accounts');
             $table->string('cheque_no')->nullable();
             $table->string('cheque_date')->nullable();
             $table->string('cheque_bank_name')->nullable();
             $table->string('type');
             $table->string('payee')->nullable();
             $table->string('Description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_vouchers');
    }
}

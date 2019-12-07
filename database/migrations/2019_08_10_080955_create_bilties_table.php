<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilties', function (Blueprint $table) {
            $table->bigIncrements('buid');
            $table->biginteger('bid')->unsigned();
            $table->foreign('bid')->references('bid')->on('brokers');

            $table->biginteger('cid')->unsigned();
            $table->foreign('cid')->references('cid')->on('companies');

            $table->string('receiving_company');
            $table->float('c_weight');
            $table->float('r_weight')->default(0.00);
            $table->float('c_rate');
            $table->string('departure');
            $table->string('destination');
            $table->string('builty_no');
            $table->string('car_no');
            $table->string('driver_name');
            $table->string('cnic');
            $table->float('total_cost');
            $table->float('b_rate');
            $table->float('pay_to_broker');
            $table->float('debit_cost');
            $table->string('invoiced')->defualt('no');
            $table->biginteger('iid')->unsigned();
            $table->foreign('iid')->references('iid')->on('invoices');
            $table->String('date');
            $table->String('month');
            
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
        Schema::dropIfExists('bilties');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('iid');
            $table->integer('b_quantity');
            $table->float('total_cost');
            $table->string('c_name');
            $table->float('sales_tax',16,2);
            $table->float('salex_tax_value',16,2);
            $table->float('cost_inc_tax',16,2);
            $table->float('payment_received',16,2)->default(0.00);
            $table->String('category');

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
        Schema::dropIfExists('invoices');
    }
}

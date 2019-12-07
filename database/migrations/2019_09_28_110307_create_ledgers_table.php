<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            
            $table->bigIncrements('lid');
            $table->string('Description');
            $table->biginteger('iid')->unsigned()->nullable();
            $table->foreign('iid')->references('iid')->on('invoices');
            $table->float('debit',16,2)->nullable();
            $table->float('credit',16,2)->nullable();
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
        Schema::dropIfExists('ledgers');
    }
}

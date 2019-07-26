<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vouchar_no');
            $table->string('product_name');
            $table->string('brand');
            $table->string('purchase_from');
            $table->float('quantity', 8, 2);
            $table->float('amount', 8, 2);
            $table->float('other_expense', 8, 2);
            $table->float('unit_price', 8, 2);
            $table->string('purchase_by');
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
        Schema::dropIfExists('purchases');
    }
}

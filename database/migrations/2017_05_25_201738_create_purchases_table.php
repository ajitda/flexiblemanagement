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
            $table->integer('qty');
            $table->decimal('weight', 15, 2);
            $table->decimal('tweight', 15, 2);
            $table->decimal('price_per_kg', 15, 2);
            $table->decimal('sub_total', 15, 2);
            $table->integer('death_qty');
            $table->integer('transport');
            $table->integer('daily_stuff_salary');
            $table->integer('others');
            $table->integer('total');
            $table->decimal('less', 15, 2);
            $table->integer('payment');
            $table->integer('dues');

            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers');

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

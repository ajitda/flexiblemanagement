<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qty');
            $table->decimal('unit_price', 15, 2);
            $table->decimal('sub_total', 15, 2);
            $table->decimal('costing', 15, 2);
            $table->decimal('total', 15, 2);
            $table->decimal('less', 15, 2);

            $table->decimal('payment', 15, 2);
            $table->string('payment_type', 15);
            $table->decimal('dues', 15, 2);

            $table->integer('feed_supplier_id')->unsigned();
            $table->foreign('feed_supplier_id')->references('id')->on('feed_suppliers');

            $table->integer('feed_customer_id')->unsigned();
            $table->foreign('feed_customer_id')->references('id')->on('feed_customers');
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
        Schema::dropIfExists('feed_sales');
    }
}

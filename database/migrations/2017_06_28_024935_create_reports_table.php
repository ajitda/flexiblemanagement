<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total_purchase', 15, 2);
            $table->decimal('total_expense', 15, 2);
            $table->decimal('total_less', 15, 2);
            $table->decimal('total_cost', 15, 2);
            $table->decimal('total_sale', 15, 2);
            $table->decimal('cheque_sale_others', 15, 2);
            $table->decimal('cash_sale', 15, 2);
            $table->decimal('collection', 15, 2);
            $table->decimal('balance', 15, 2);
            $table->decimal('profit', 15, 2);
            $table->decimal('previous_balance', 15, 2);
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
        Schema::dropIfExists('reports');
    }
}

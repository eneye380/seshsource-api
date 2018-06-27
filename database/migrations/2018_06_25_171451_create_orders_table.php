<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id'); 
            $table->primary('id');
            $table->string('status')->default('processing')->comment('processing (order made, waiting payment), completed (paid, tickets emailed), refunded');
            $table->dateTime('order_date');
            $table->uuid('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('payment_gateway');
            $table->decimal('discount', 8, 2);
            $table->decimal('order_total', 8, 2);
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
        Schema::dropIfExists('orders');
    }
}

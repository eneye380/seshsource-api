<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id'); 
            $table->primary('id');
            $table->boolean('status')->default(false);
            $table->uuid('ticket_type');
            $table->foreign('ticket_type')->references('id')->on('ticket_types')->onDelete('cascade');
            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->uuid('order_item_id');
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
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
        Schema::dropIfExists('tickets');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->uuid('id'); 
            $table->primary('id');
            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->integer('max_each')->comment('max to sell per customer');
            $table->integer('max_quantity')->comment('max total tickets to sell');
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
        Schema::dropIfExists('ticket_types');
    }
}

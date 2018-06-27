<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_templates', function (Blueprint $table) {
            $table->uuid('id'); 
            $table->primary('id');
            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->string('name');
            $table->string('ticket_size');
            $table->string('orientation');
            $table->string('ticket_background');
            $table->string('font');
            $table->longText('ticket_content')->comment('content block values stored with JSON');
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
        Schema::dropIfExists('ticket_templates');
    }
}

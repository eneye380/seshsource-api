<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->uuid('id'); 
            $table->primary('id');
            $table->boolean('status')->default(true)->comment('If user has ticket problems, app sets status to false to keep track of failed checkins');
            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->uuid('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
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
        Schema::dropIfExists('check_ins');
    }
}

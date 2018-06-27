<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_meta', function (Blueprint $table) {
            $table->uuid('id'); 
            $table->primary('id');
            $table->uuid('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->string('meta_type');
            $table->string('meta_value');
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
        Schema::dropIfExists('event_meta');
    }
}

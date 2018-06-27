<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id'); 
            $table->primary('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('video_embed')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code')->nullable();
            $table->string('country')->default('USA');
            $table->string('website')->nullable();
            $table->string('email');
            $table->uuid('organizer_id');
            $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('view_count')->default(0);
            $table->integer('rating')->default(0);
            $table->string('event_logo')->nullable();
            $table->string('featured_img')->nullable();
            $table->longText('terms')->nullable();
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
        Schema::dropIfExists('events');
    }
}

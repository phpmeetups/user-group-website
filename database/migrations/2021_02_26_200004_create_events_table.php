<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('uuid')->index()->unique();
            $table->string('featured_photo_url')->nullable(); // (1200x675)
            $table->string('title')->index();
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->dateTime('rsvp_starts_at')->nullable();
            $table->dateTime('rsvp_ends_at')->nullable();
            $table->string('type');
            $table->text('online_instructions')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('attendee_limit')->nullable();
            $table->unsignedInteger('allowed_guests')->nullable();
            $table->string('status')->default('active');

            $table->timestamps();
            $table->softDeletes();
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

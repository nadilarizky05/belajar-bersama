<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('room_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('joined_at');
            $table->timestamp('left_at')->nullable();
            $table->timestamps();

            $table->string('video_preview_url')->nullable();
            $table->boolean('host_camera_on')->default(false);
            $table->boolean('host_mic_on')->default(false);
            $table->boolean('study_timer_active')->default(false);
            $table->string('study_timer_remaining')->nullable();
            $table->string('current_activity')->nullable();

            $table->foreign('room_id')->references('id')->on('study_rooms');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['room_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('room_participants');
    }
};
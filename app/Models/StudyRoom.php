<?php
// app/Models/StudyRoom.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject',
        'description',
        'zoom_meeting_id',
        'zoom_join_url',
        'zoom_password',
        'creator_id',
        'participant_count',
        'is_active',
        'started_at',
        'ended_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function participants()
    {
        return $this->hasMany(RoomParticipant::class, 'room_id');
    }

    public function activeParticipants()
    {
        return $this->participants()->whereNull('left_at');
    }

    public function updateParticipantCount()
    {
        $this->participant_count = $this->activeParticipants()->count();
        $this->save();
    }
}
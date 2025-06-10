<?php

namespace App\Http\Controllers;

use App\Models\StudyRoom;
use App\Models\RoomParticipant;
use App\Services\ZoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StudyRoomController extends Controller
{
    private $zoomService;

    public function __construct(ZoomService $zoomService)
    {
        $this->zoomService = $zoomService;
    }

    public function index()
    {
        $rooms = StudyRoom::with('creator')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500'
        ]);

        try {
            // Create Zoom meeting
            $meetingData = $this->zoomService->createMeeting(
                $request->name . ' - Study Room',
                120 // 2 hours
            );

            // Log untuk debugging
            Log::info('Zoom Meeting Created:', $meetingData);

            // Create study room
            $room = StudyRoom::create([
                'name' => $request->name,
                'subject' => $request->subject,
                'description' => $request->description,
                'zoom_meeting_id' => $meetingData['meeting_id'],
                'zoom_join_url' => $meetingData['join_url'],
                'zoom_password' => $meetingData['password'],
                'creator_id' => Auth::id(),
                'started_at' => now()
            ]);

            // Add creator as participant
            RoomParticipant::create([
                'room_id' => $room->id,
                'user_id' => Auth::id(),
                'joined_at' => now()
            ]);

            $room->updateParticipantCount();

            return redirect()->route('rooms.show', $room->id)
                ->with('success', 'Study room created successfully!');

        } catch (\Exception $e) {
            Log::error('Error creating study room: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create study room. Please check your Zoom API configuration. Error: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $room = StudyRoom::with(['creator', 'participants.user'])->findOrFail($id);
        
        return view('rooms.show', compact('room'));
    }

    public function join($id)
    {
        $room = StudyRoom::findOrFail($id);

        if (!$room->is_active) {
            return redirect()->back()->with('error', 'This study room is no longer active.');
        }

        // Check if user already joined
        $existingParticipant = RoomParticipant::where('room_id', $id)
            ->where('user_id', Auth::id())
            ->whereNull('left_at')
            ->first();

        if (!$existingParticipant) {
            // Add user as participant
            RoomParticipant::create([
                'room_id' => $id,
                'user_id' => Auth::id(),
                'joined_at' => now()
            ]);

            $room->updateParticipantCount();
        }

        // Debug: Log join URL
        Log::info('Joining Zoom meeting: ' . $room->zoom_join_url);

        // Redirect to Zoom
        return redirect($room->zoom_join_url);
    }

    public function leave($id)
    {
        $participant = RoomParticipant::where('room_id', $id)
            ->where('user_id', Auth::id())
            ->whereNull('left_at')
            ->first();

        if ($participant) {
            $participant->update(['left_at' => now()]);
            
            $room = StudyRoom::findOrFail($id);
            $room->updateParticipantCount();
        }

        return redirect()->route('rooms.index')
            ->with('success', 'You have left the study room.');
    }

     public function debugZoom()
    {
        $accountId = config('services.zoom.account_id');
        $clientId = config('services.zoom.client_id');
        $clientSecret = config('services.zoom.client_secret');

        return response()->json([
            'account_id_exists' => !empty($accountId),
            'client_id_exists' => !empty($clientId),
            'client_secret_exists' => !empty($clientSecret),
            'account_id_length' => strlen($accountId ?? ''),
            'client_id_length' => strlen($clientId ?? ''),
            'client_secret_length' => strlen($clientSecret ?? ''),
            // Jangan tampilkan nilai asli untuk keamanan
            'account_id_preview' => substr($accountId ?? '', 0, 8) . '...',
            'client_id_preview' => substr($clientId ?? '', 0, 8) . '...',
        ]);
    }


    /**
     * Test Zoom API connection
     */
    public function testZoom()
    {
        try {
            $meetingData = $this->zoomService->createMeeting('Test Meeting', 30);
            
            return response()->json([
                'success' => true,
                'message' => 'Zoom API is working!',
                'data' => $meetingData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Zoom API Error: ' . $e->getMessage()
            ]);
        }
    }
}
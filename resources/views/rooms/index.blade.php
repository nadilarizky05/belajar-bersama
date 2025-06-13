@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-teal-500 via-teal-600 to-green-700 min-h-[60vh] flex items-center">
        <div class="max-w-7xl mx-auto px-4 py-16 sm:py-24 w-full">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                    BelajarBersama
                </h1>
                <p class="text-xl md:text-2xl text-white/90 mb-8 max-w-3xl mx-auto">
                    Platform Pembelajaran Mahasiswa Kolaboratif Berbasis Web
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <div class="relative">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-lg blur opacity-75">
                        </div>
                        <a href="{{ route('rooms.create') }}"
                            class="relative bg-white text-teal-700 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-50 transition-colors duration-200 flex items-center gap-2">
                            🚀 Mulai Belajar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-teal-50 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-teal-800 mb-4">Fitur Inovatif</h2>
                <p class="text-teal-600">Solusi pembelajaran yang dirancang khusus untuk mahasiswa modern</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1 -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-teal-500 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-white text-xl">💬</span>
                    </div>
                    <h3 class="font-bold text-teal-800 mb-2">Chat Real-time</h3>
                    <p class="text-teal-600 text-sm">Komunikasi langsung antar peserta</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-white text-xl">📹</span>
                    </div>
                    <h3 class="font-bold text-teal-800 mb-2">Video Call Terintegrasi</h3>
                    <p class="text-teal-600 text-sm">Zoom/Google Meet integration</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-white text-xl">📊</span>
                    </div>
                    <h3 class="font-bold text-teal-800 mb-2">Manajemen Jadwal</h3>
                    <p class="text-teal-600 text-sm">Kelola waktu belajar dengan efisien</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-white text-xl">✅</span>
                    </div>
                    <h3 class="font-bold text-teal-800 mb-2">Pratinjau Sesi</h3>
                    <p class="text-teal-600 text-sm">Lihat aktivitas sebelum bergabung</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('rooms.create') }}"
                class="bg-gradient-to-r from-yellow-400 to-orange-400 hover:from-yellow-500 hover:to-orange-500 text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 flex items-center gap-2">
                ✨ Create Your Room
            </a>
        </div>
    </div>

    <!-- Rooms Grid -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-teal-800 mb-4">Room Belajar Aktif</h2>
            <p class="text-teal-600">Bergabunglah dengan sesi belajar yang sedang berlangsung</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($rooms as $room)
                <div
                    class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-teal-100 room-card">

                    <!-- Live Video Preview Section -->
                    <div class="relative bg-gray-900 aspect-video overflow-hidden video-preview">
                        @if($room->is_live)
                            @if($room->zoom_meeting_id && $room->video_preview_url)
                                <!-- Live Video Stream from Zoom -->
                                <div class="relative w-full h-full">
                                    <iframe src="{{ $room->video_preview_url }}" class="w-full h-full object-cover" frameborder="0"
                                        allow="camera; microphone; fullscreen; display-capture">
                                    </iframe>
                                    <!-- Fallback for iframe loading -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-teal-600 to-teal-800 flex items-center justify-center"
                                        id="loading-{{ $room->id }}">
                                        <div class="text-center text-white">
                                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-white mx-auto mb-4"></div>
                                            <p class="text-sm">Loading video...</p>
                                        </div>
                                    </div>
                                </div>
                            @elseif($room->zoom_meeting_id)
                                <!-- Live Session Indicator without video -->
                                <div
                                    class="w-full h-full bg-gradient-to-br from-teal-600 via-teal-700 to-green-800 flex items-center justify-center relative">
                                    <div class="text-center text-white">
                                        <div
                                            class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mb-4 mx-auto animate-pulse">
                                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold mb-2">Sesi Aktif</h3>
                                        <p class="text-teal-100">Video call sedang berlangsung</p>
                                    </div>
                                    <!-- Animated background elements -->
                                    <div class="absolute top-4 left-4 w-3 h-3 bg-green-400 rounded-full animate-ping"></div>
                                    <div class="absolute bottom-6 right-6 w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
                                    <div class="absolute top-1/3 right-8 w-4 h-4 bg-blue-400 rounded-full animate-bounce"></div>
                                </div>
                            @else
                                <!-- Host Avatar with Live Effects -->
                                <div class="relative w-full h-full">
                                    @if($room->creator->avatar)
                                        <img src="{{ $room->creator->avatar }}" alt="{{ $room->creator->name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-teal-600 to-teal-800 flex items-center justify-center">
                                            <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                                                <span class="text-white font-bold text-3xl">{{ substr($room->creator->name, 0, 1) }}</span>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- Live overlay effects -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                                    <div class="absolute inset-0 bg-green-500/10 animate-pulse"></div>
                                </div>
                            @endif
                        @else
                            <!-- Inactive room preview -->
                            @if($room->creator->avatar)
                                <img src="{{ $room->creator->avatar }}" alt="{{ $room->creator->name }}"
                                    class="w-full h-full object-cover opacity-60">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-600 to-gray-800 flex items-center justify-center">
                                    <div class="text-center text-white/60">
                                        <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                        </svg>
                                        <p class="text-sm">Room Inactive</p>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Live Indicator -->
                        @if($room->is_live)
                            <div
                                class="absolute top-3 left-3 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1 animate-pulse">
                                <div class="w-2 h-2 bg-white rounded-full animate-ping"></div>
                                LIVE
                            </div>
                        @else
                            <div class="absolute top-3 left-3 bg-gray-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                OFFLINE
                            </div>
                        @endif

                        <!-- Viewer Count Overlay -->
                        <div
                            class="absolute top-3 right-3 bg-black/50 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $room->participant_count ?? 0 }}
                        </div>

                        <!-- Study Timer (if active) -->
                        @if($room->study_timer_active ?? false)
                            <div
                                class="absolute bottom-3 left-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold animate-pulse">
                                ⏱️ {{ $room->study_timer_remaining ?? '00:00' }}
                            </div>
                        @endif

                        <!-- Camera/Mic Status -->
                        <div class="absolute bottom-3 right-3 flex gap-2">
                            @if($room->host_camera_on ?? $room->is_live)
                                <div class="bg-green-500 p-1.5 rounded-full animate-pulse">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                    </svg>
                                </div>
                            @endif
                            @if($room->host_mic_on ?? $room->is_live)
                                <div class="bg-blue-500 p-1.5 rounded-full animate-pulse">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                        @if($room->creator->avatar)
                                            <img src="{{ $room->creator->avatar }}" alt="{{ $room->creator->name }}"
                                                class="w-full h-full rounded-full object-cover">
                                        @else
                                            <span
                                                class="text-white font-bold text-lg">{{ substr($room->creator->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    @if($room->creator->is_online ?? $room->is_live)
                                        <div
                                            class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full animate-pulse">
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-bold text-white text-lg">{{ $room->creator->name }}</h3>
                                    <p class="text-teal-100 text-sm">Host</p>
                                </div>
                            </div>
                            <div class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                                <span class="text-white text-sm font-semibold">
                                    👥 {{ $room->participant_count ?? 0 }}
                                </span>
                            </div>
                        </div>

                        @if($room->subject)
                            <div
                                class="inline-block bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-4 py-2 rounded-full text-sm font-bold">
                                📚 {{ $room->subject }}
                            </div>
                        @endif
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <h4 class="font-bold text-teal-800 text-xl mb-3">{{ $room->name }}</h4>

                        @if($room->description)
                            <p class="text-teal-600 text-sm mb-4 line-clamp-3">{{ $room->description }}</p>
                        @endif

                        <!-- Study Session Info -->
                        @if($room->current_activity)
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-yellow-600 font-semibold text-sm">📖 Sedang:</span>
                                    <span class="text-yellow-700 text-sm">{{ $room->current_activity }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- Room Status -->
                        @if($room->is_live)
                            <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="text-green-700 text-sm font-semibold">
                                        @if($room->zoom_meeting_id)
                                            Video call aktif - Zoom Meeting
                                        @else
                                            Sesi belajar sedang berlangsung
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endif

                        <!-- Stats -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-teal-50 p-3 rounded-lg text-center">
                                <div class="text-2xl font-bold text-teal-600">{{ $room->participant_count ?? 0 }}</div>
                                <div class="text-teal-500 text-sm">Peserta</div>
                            </div>
                            <div class="bg-green-50 p-3 rounded-lg text-center">
                                <div class="text-lg font-bold text-green-600">{{ $room->created_at->diffForHumans() }}</div>
                                <div class="text-green-500 text-sm">Dimulai</div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <a href="{{ route('rooms.show', $room->id) }}"
                                class="flex-1 bg-teal-500 hover:bg-teal-600 text-white px-4 py-3 rounded-lg font-semibold text-center transition-colors duration-200 flex items-center justify-center gap-2">
                                👁️ Lihat
                            </a>
                            <form method="POST" action="{{ route('rooms.join', $room->id) }}" class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-yellow-400 to-orange-400 hover:from-yellow-500 hover:to-orange-500 text-white px-4 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2 transform hover:scale-105">
                                    @if($room->is_live)
                                        🚀 Gabung Live
                                    @else
                                        📞 Gabung Room
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                        <div class="w-24 h-24 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="text-4xl">📚</span>
                        </div>
                        <h3 class="text-2xl font-bold text-teal-800 mb-4">Belum Ada Room Aktif</h3>
                        <p class="text-teal-600 mb-8 max-w-md mx-auto">
                            Jadilah yang pertama membuat room belajar dan ajak teman-teman untuk belajar bersama!
                        </p>
                        <a href="{{ route('rooms.create') }}"
                            class="inline-flex items-center gap-2 bg-gradient-to-r from-yellow-400 to-orange-400 hover:from-yellow-500 hover:to-orange-500 text-white px-8 py-4 rounded-xl font-bold transition-all duration-200 transform hover:scale-105">
                            ✨ Buat Room Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Tech Stack -->
    <div class="bg-white py-1">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <p class="text-teal-600 my-2"><b>Copyright 2025 by Kelompok A</b></p>
        </div>
    </div>

    <!-- Auto-refresh for live updates -->
    <script>
        // Auto refresh live video previews every 30 seconds
        setInterval(function () {
            const liveRooms = document.querySelectorAll('[data-room-live="true"]');
            liveRooms.forEach(function (room) {
                const iframe = room.querySelector('iframe');
                if (iframe) {
                    // Refresh iframe src to get updated video
                    const currentSrc = iframe.src;
                    iframe.src = '';
                    setTimeout(() => {
                        iframe.src = currentSrc;
                    }, 100);
                }
            });
        }, 30000);

        // Hide loading overlay when iframe loads
        document.addEventListener('DOMContentLoaded', function () {
            const iframes = document.querySelectorAll('iframe');
            iframes.forEach(function (iframe) {
                iframe.addEventListener('load', function () {
                    const roomId = this.closest('.room-card').getAttribute('data-room-id');
                    const loader = document.getElementById('loading-' + roomId);
                    if (loader) {
                        loader.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <!-- Custom CSS for animations -->
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        @keyframes ping {

            75%,
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(-25%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            50% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .animate-ping {
            animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        .animate-bounce {
            animation: bounce 1s infinite;
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Hover effects for cards */
        .room-card:hover .video-preview {
            transform: scale(1.02);
            transition: transform 0.3s ease;
        }

        /* Better iframe styling */
        iframe {
            border-radius: 0;
            background: #000;
        }

        /* Loading states */
        .video-preview iframe {
            transition: opacity 0.3s ease;
        }

        .video-preview iframe:not([src]) {
            opacity: 0;
        }
    </style>

    <!-- Add room data attributes for JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @foreach($rooms as $room)
                const roomCard{{ $room->id }} = document.querySelector('[data-room-id="{{ $room->id }}"]');
                if (roomCard{{ $room->id }}) {
                    roomCard{{ $room->id }}.setAttribute('data-room-live', '{{ $room->is_live ? "true" : "false" }}');
                }
            @endforeach
            });
    </script>
@endsection
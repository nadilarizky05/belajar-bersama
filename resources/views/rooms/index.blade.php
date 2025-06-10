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
            {{-- <button
                class="bg-white border-2 border-teal-500 text-teal-600 hover:bg-teal-500 hover:text-white font-bold px-8 py-4 rounded-xl transition-all duration-200 flex items-center gap-2">
                🔍 Filter Rooms
            </button> --}}
        </div>
    </div>

    <!-- Problem Statement -->
    {{-- <div class="bg-gradient-to-r from-orange-100 to-yellow-100 py-12">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="text-white text-xl">⚠️</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-teal-800 mb-4">Masalah yang Dihadapi</h3>
                        <p class="text-teal-700 leading-relaxed">
                            Mahasiswa kesulitan mengatur waktu belajar dan mempertahankan motivasi saat belajar mandiri.
                            Mereka ingin belajar bersama tetapi sulit menemukan rekan dengan minat dan topik yang sama.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Rooms Grid -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-teal-800 mb-4">Room Belajar Aktif</h2>
            <p class="text-teal-600">Bergabunglah dengan sesi belajar yang sedang berlangsung</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($rooms as $room)
                <div
                    class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-teal-100">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">{{ substr($room->creator->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-white text-lg">{{ $room->creator->name }}</h3>
                                    <p class="text-teal-100 text-sm">Host</p>
                                </div>
                            </div>
                            <div class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                                <span class="text-white text-sm font-semibold">
                                    👥 {{ $room->participant_count }}
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

                        <!-- Stats -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-teal-50 p-3 rounded-lg text-center">
                                <div class="text-2xl font-bold text-teal-600">{{ $room->participant_count }}</div>
                                <div class="text-teal-500 text-sm">Peserta</div>
                            </div>
                            <div class="bg-green-50 p-3 rounded-lg text-center">
                                <div class="text-2xl font-bold text-green-600">{{ $room->created_at->diffForHumans() }}</div>
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
                                    class="w-full bg-gradient-to-r from-yellow-400 to-orange-400 hover:from-yellow-500 hover:to-orange-500 text-white px-4 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                                    🚀 Gabung
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

    <!-- Team Section -->
    {{-- <div class="bg-teal-50 py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-teal-800 mb-8">Kelompok A</h2>
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-teal-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white text-xl font-bold">CR</span>
                            </div>
                            <h4 class="font-bold text-teal-800">Cornelius Rizki</h4>
                            <p class="text-teal-600 text-sm">043096450</p>
                        </div>
                        <div class="text-center ml-8">
                            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white text-xl font-bold">HR</span>
                            </div>
                            <h4 class="font-bold text-teal-800">Hedda Ramadhani</h4>
                            <p class="text-teal-600 text-sm">043093576</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white text-xl font-bold">NR</span>
                            </div>
                            <h4 class="font-bold text-teal-800">Nadia Rizky</h4>
                            <p class="text-teal-600 text-sm">043594676</p>
                        </div>
                        <div class="text-center ml-8">
                            <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white text-xl font-bold">RA</span>
                            </div>
                            <h4 class="font-bold text-teal-800">Rolan Arruda</h4>
                            <p class="text-teal-600 text-sm">043313650</p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-6">
                    <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-white text-xl font-bold">SY</span>
                    </div>
                    <h4 class="font-bold text-teal-800">Selvy Yusman</h4>
                    <p class="text-teal-600 text-sm">043505861</p>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Tech Stack -->
    <div class="bg-white py-1">
        <div class="max-w-4xl mx-auto px-4 text-center">
            {{-- <h2 class="text-3xl font-bold text-teal-800 mb-8">BelajarBersama</h2> --}}
            <p class="text-teal-600 my-2"><b>Copyright 2025 by Kelompok A</b></p>

            {{-- <div class="flex flex-wrap justify-center gap-4">
                <span class="bg-blue-500 text-white px-6 py-3 rounded-full font-semibold">React.js</span>
                <span class="bg-green-500 text-white px-6 py-3 rounded-full font-semibold">Laravel</span>
                <span class="bg-yellow-500 text-white px-6 py-3 rounded-full font-semibold">MySQL</span>
            </div> --}}
        </div>
    </div>
@endsection
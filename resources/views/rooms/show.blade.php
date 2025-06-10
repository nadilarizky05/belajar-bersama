@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
        <div class="bg-gradient-to-br from-teal-500 via-teal-600 to-green-700 py-16">
            <div class="max-w-4xl mx-auto px-4">
                <div class="text-center text-white mb-8">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">🎓</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $room->name }}</h1>
                    <p class="text-xl text-teal-100">
                        <span class="inline-flex items-center gap-2">
                            <span>👨‍🏫</span>
                            Dibuat oleh {{ $room->creator->name }}
                        </span>
                    </p>
                </div>

                @if($room->subject)
                    <div class="text-center">
                        <span class="inline-block bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-6 py-3 rounded-full text-lg font-bold">
                            📚 {{ $room->subject }}
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 -mt-8 pb-16">
            <!-- Main Content -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Stats Header -->
                <div class="bg-gradient-to-r from-teal-50 to-green-50 p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-teal-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white text-2xl font-bold">{{ $room->participant_count }}</span>
                            </div>
                            <h3 class="font-bold text-teal-800">Peserta Aktif</h3>
                            <p class="text-teal-600 text-sm">sedang belajar</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white text-xl">⏰</span>
                            </div>
                            <h3 class="font-bold text-teal-800">Waktu Mulai</h3>
                            <p class="text-teal-600 text-sm">{{ $room->created_at->format('H:i, d M Y') }}</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white text-xl">🎯</span>
                            </div>
                            <h3 class="font-bold text-teal-800">Status</h3>
                            <p class="text-green-600 text-sm font-semibold">✅ Aktif</p>
                        </div>
                    </div>
                </div>

                <!-- Room Description -->
                @if($room->description)
                    <div class="p-8 border-b border-teal-100">
                        <h3 class="font-bold text-teal-800 text-xl mb-4 flex items-center gap-2">
                            <span class="text-teal-500">💭</span>
                            Deskripsi Room
                        </h3>
                        <div class="bg-teal-50 rounded-xl p-6">
                            <p class="text-teal-700 leading-relaxed">{{ $room->description }}</p>
                        </div>
                    </div>
                @endif

                <!-- Zoom Meeting Details -->
                <div class="p-8 border-b border-teal-100">
                    <h3 class="font-bold text-teal-800 text-xl mb-6 flex items-center gap-2">
                        <span class="text-teal-500">📹</span>
                        Detail Zoom Meeting
                    </h3>

                    <div class="bg-gradient-to-r from-blue-50 to-teal-50 rounded-2xl p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="bg-white rounded-xl p-6 shadow-sm">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                        <span class="text-white">🆔</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-teal-800">Meeting ID</h4>
                                        <p class="text-blue-600 font-mono text-lg">{{ $room->zoom_meeting_id }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($room->zoom_password)
                                <div class="bg-white rounded-xl p-6 shadow-sm">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                            <span class="text-white">🔐</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-teal-800">Password</h4>
                                            <p class="text-green-600 font-mono text-lg">{{ $room->zoom_password }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <form method="POST" action="{{ route('rooms.join', $room->id) }}" class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-yellow-400 to-orange-400 hover:from-yellow-500 hover:to-orange-500 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-200 transform hover:scale-[1.02] hover:shadow-xl flex items-center justify-center gap-3">
                                    <span class="text-xl">🚀</span>
                                    Gabung ke Zoom Meeting
                                </button>
                            </form>

                            <button onclick="copyToClipboard('{{ $room->zoom_join_url }}')"
                                class="flex-1 bg-teal-500 hover:bg-teal-600 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-200 flex items-center justify-center gap-3">
                                <span class="text-xl">📋</span>
                                Copy Link
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Active Participants -->
                <div class="p-8">
                    <h3 class="font-bold text-teal-800 text-xl mb-6 flex items-center gap-2">
                        <span class="text-teal-500">👥</span>
                        Peserta Aktif ({{ count($room->activeParticipants) }})
                    </h3>

                    @if(count($room->activeParticipants) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($room->activeParticipants as $participant)
                                <div class="bg-gradient-to-r from-teal-50 to-green-50 rounded-xl p-6 text-center border border-teal-100 hover:shadow-lg transition-shadow duration-200">
                                    <div class="w-12 h-12 bg-teal-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <span class="text-white font-bold">
                                            {{ substr($participant->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-teal-800 mb-1">{{ $participant->user->name }}</h4>
                                    <p class="text-teal-600 text-sm">
                                        ⏰ Bergabung {{ $participant->joined_at->diffForHumans() }}
                                    </p>
                                    @if($participant->user->id === $room->creator_id)
                                        <span class="inline-block bg-yellow-400 text-white px-3 py-1 rounded-full text-xs font-bold mt-2">
                                            👑 Host
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-4xl">😴</span>
                            </div>
                            <h4 class="font-bold text-teal-800 mb-2">Belum Ada Peserta Aktif</h4>
                            <p class="text-teal-600">Jadilah yang pertama bergabung ke room ini!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('rooms.index') }}"
                    class="bg-white border-2 border-teal-500 text-teal-600 hover:bg-teal-500 hover:text-white px-8 py-4 rounded-xl font-bold transition-all duration-200 flex items-center justify-center gap-2">
                    <span>←</span> Kembali ke Rooms
                </a>

                @if(Auth::id() !== $room->creator_id)
                    <form method="POST" action="{{ route('rooms.leave', $room->id) }}">
                        @csrf
                        <button type="submit" 
                            class="bg-red-500 hover:bg-red-600 text-white px-8 py-4 rounded-xl font-bold transition-colors duration-200 flex items-center gap-2">
                            <span>🚪</span> Keluar Room
                        </button>
                    </form>
                @else
                    <div class="bg-green-100 border border-green-200 text-green-800 px-8 py-4 rounded-xl flex items-center gap-2">
                        <span>👑</span> Anda adalah Host room ini
                    </div>
                @endif
            </div>

            <!-- Success Toast -->
            <div id="copyToast" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
                <div class="flex items-center gap-2">
                    <span>✅</span>
                    <span>Link berhasil disalin!</span>
                </div>
            </div>
        </div>

        <script>
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(function () {
                    // Show toast
                    const toast = document.getElementById('copyToast');
                    toast.classList.remove('translate-x-full');

                    // Hide toast after 3 seconds
                    setTimeout(() => {
                        toast.classList.add('translate-x-full');
                    }, 3000);
                }).catch(function(err) {
                    alert('Gagal menyalin link: ' + err);
                });
            }
        </script>
@endsection
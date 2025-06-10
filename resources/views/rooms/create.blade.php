@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-teal-500 via-teal-600 to-green-700 py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                ✨ Buat Room Belajar Baru
            </h1>
            <p class="text-xl text-white/90 mb-8">
                Mulai sesi belajar kolaboratif dan ajak teman-teman bergabung
            </p>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 -mt-8 pb-16">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-8 text-center">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-3xl">🚀</span>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Create Study Room</h2>
                <p class="text-teal-100">Siapkan ruang belajar virtual Anda</p>
            </div>

            <!-- Form Section -->
            <div class="p-8">
                {{-- Display Success Message --}}
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-6 flex items-center gap-3">
                        <span class="text-green-500 text-xl">✅</span>
                        <div>
                            <div class="font-semibold">Berhasil!</div>
                            <div class="text-sm">{{ session('success') }}</div>
                        </div>
                    </div>
                @endif

                {{-- Display Error Message --}}
                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6 flex items-center gap-3">
                        <span class="text-red-500 text-xl">❌</span>
                        <div>
                            <div class="font-semibold">Oops!</div>
                            <div class="text-sm">{{ session('error') }}</div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('rooms.store') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Room Name -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-teal-800 mb-3 flex items-center gap-2">
                            <span class="text-teal-500">📝</span>
                            Nama Room
                        </label>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}"
                            class="w-full px-6 py-4 border-2 border-teal-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-teal-100 focus:border-teal-500 transition-all duration-200 text-teal-800 placeholder-teal-400"
                            placeholder="e.g., Finals Study Session, Diskusi Algoritma">
                        @error('name')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <span>⚠️</span> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-bold text-teal-800 mb-3 flex items-center gap-2">
                            <span class="text-teal-500">📚</span>
                            Mata Kuliah <span class="text-teal-500 font-normal">(Opsional)</span>
                        </label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                            class="w-full px-6 py-4 border-2 border-teal-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-teal-100 focus:border-teal-500 transition-all duration-200 text-teal-800 placeholder-teal-400"
                            placeholder="e.g., Matematika, Fisika, Pemrograman">
                        @error('subject')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <span>⚠️</span> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-bold text-teal-800 mb-3 flex items-center gap-2">
                            <span class="text-teal-500">💭</span>
                            Deskripsi <span class="text-teal-500 font-normal">(Opsional)</span>
                        </label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full px-6 py-4 border-2 border-teal-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-teal-100 focus:border-teal-500 transition-all duration-200 text-teal-800 placeholder-teal-400 resize-none"
                            placeholder="Apa yang akan kalian pelajari hari ini? Jelaskan topik atau tujuan belajar...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <span>⚠️</span> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-yellow-400 to-orange-400 hover:from-yellow-500 hover:to-orange-500 text-white py-4 px-8 rounded-xl font-bold text-lg transition-all duration-200 transform hover:scale-[1.02] hover:shadow-xl flex items-center justify-center gap-3">
                            <span class="text-xl">🎯</span>
                            Buat Room & Generate Zoom Link
                        </button>
                    </div>
                </form>

                {{-- Test Zoom Button (hanya untuk development) --}}
                @if(config('app.debug'))
                    <div class="mt-8 pt-8 border-t border-teal-100">
                        <div class="bg-teal-50 rounded-xl p-6">
                            <h3 class="font-bold text-teal-800 mb-3 flex items-center gap-2">
                                <span class="text-teal-500">🔧</span>
                                Development Tools
                            </h3>
                            <p class="text-teal-600 text-sm mb-4">
                                Tools ini hanya tersedia dalam mode development untuk testing API Zoom
                            </p>
                            <a href="/test-zoom"
                                class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold transition-colors duration-200">
                                <span>🧪</span>
                                Test Zoom API Connection
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Features Info -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="w-12 h-12 bg-teal-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-xl">⚡</span>
                </div>
                <h3 class="font-bold text-teal-800 mb-2">Instant Setup</h3>
                <p class="text-teal-600 text-sm">Room langsung siap dengan link Zoom otomatis</p>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-xl">👥</span>
                </div>
                <h3 class="font-bold text-teal-800 mb-2">Kolaboratif</h3>
                <p class="text-teal-600 text-sm">Ajak teman dan belajar bersama secara real-time</p>
            </div>
            
            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-xl">📊</span>
                </div>
                <h3 class="font-bold text-teal-800 mb-2">Tracking</h3>
                <p class="text-teal-600 text-sm">Monitor peserta dan progress belajar</p>
            </div>
        </div>
    </div>
@endsection
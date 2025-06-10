@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-teal-500 via-teal-600 to-green-700 min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-4 py-16 w-full">
            <div class="text-center">
                <!-- Logo/Icon -->
                <div
                    class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-8 backdrop-blur-sm">
                    <span class="text-6xl">🎓</span>
                </div>

                <!-- Main Title -->
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6">
                    Welcome to
                    <span class="bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text text-transparent">
                        BelajarBersama
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-white/90 mb-4 max-w-4xl mx-auto leading-relaxed">
                    Platform Pembelajaran Mahasiswa Kolaboratif Berbasis Web
                </p>
                <p class="text-lg md:text-xl text-teal-100 mb-12 max-w-3xl mx-auto">
                    Always be productive with virtual study sessions
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    @auth
                        <div class="relative group">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-2xl blur opacity-75 group-hover:opacity-100 transition duration-200">
                            </div>
                            <a href="{{ route('rooms.index') }}"
                                class="relative bg-white text-teal-700 px-10 py-5 rounded-2xl font-bold text-xl hover:bg-gray-50 transition-colors duration-200 flex items-center gap-3">
                                <span class="text-2xl">🚀</span>
                                Go to Study Rooms
                            </a>
                        </div>
                    @else
                        <div class="relative group">
                            <div
                                class="absolute -inset-1 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-2xl blur opacity-75 group-hover:opacity-100 transition duration-200">
                            </div>
                            <a href="{{ route('register') }}"
                                class="relative bg-white text-teal-700 px-10 py-5 rounded-2xl font-bold text-xl hover:bg-gray-50 transition-colors duration-200 flex items-center gap-3">
                                <span class="text-2xl">✨</span>
                                Get Started
                            </a>
                        </div>

                        <a href="{{ route('login') }}"
                            class="bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white px-10 py-5 rounded-2xl font-bold text-xl hover:bg-white/20 transition-all duration-200 flex items-center gap-3">
                            <span class="text-2xl">🔑</span>
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-teal-50 py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-teal-800 mb-6">Kenapa Memilih BelajarBersama?</h2>
                <p class="text-xl text-teal-600">Solusi pembelajaran kolaboratif yang dirancang khusus untuk mahasiswa
                    modern</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div
                    class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 text-center">
                    <div class="w-16 h-16 bg-teal-500 rounded-xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-2xl">💬</span>
                    </div>
                    <h3 class="font-bold text-teal-800 text-xl mb-4">Chat Real-time</h3>
                    <p class="text-teal-600">Komunikasi langsung antar peserta untuk diskusi yang lebih efektif</p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 text-center">
                    <div class="w-16 h-16 bg-green-500 rounded-xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-2xl">📹</span>
                    </div>
                    <h3 class="font-bold text-teal-800 text-xl mb-4">Video Call Terintegrasi</h3>
                    <p class="text-teal-600">Zoom/Google Meet integration untuk sesi belajar tatap muka</p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 text-center">
                    <div class="w-16 h-16 bg-yellow-500 rounded-xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-2xl">📊</span>
                    </div>
                    <h3 class="font-bold text-teal-800 text-xl mb-4">Manajemen Jadwal</h3>
                    <p class="text-teal-600">Kelola waktu belajar dengan efisien dan jadwal yang terstruktur</p>
                </div>

                <!-- Feature 4 -->
                <div
                    class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 text-center">
                    <div class="w-16 h-16 bg-orange-500 rounded-xl flex items-center justify-center mx-auto mb-6">
                        <span class="text-white text-2xl">🤝</span>
                    </div>
                    <h3 class="font-bold text-teal-800 text-xl mb-4">Kolaborasi Mudah</h3>
                    <p class="text-teal-600">Fitur berbagi layar dan whiteboard untuk pembelajaran interaktif</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Problem Statement Section -->
    <div class="bg-white py-20">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Problem Text -->
                <div class="order-2 lg:order-1">
                    <div class="bg-gradient-to-r from-orange-400 to-yellow-400 inline-block px-4 py-2 rounded-full mb-6">
                        <span class="text-white font-bold flex items-center gap-2">
                            <span class="text-xl">⚠️</span>
                            Masalah yang Dihadapi
                        </span>
                    </div>
                    <h2 class="text-3xl font-bold text-teal-800 mb-6">
                        Mahasiswa kesulitan mengatur waktu belajar dan memprioritaskan motivasi saat belajar mandiri
                    </h2>
                    <p class="text-lg text-teal-600 mb-6">
                        Mereka ingin belajar bersama tetapi sulit menemukan rekan dengan minat dan topik yang sama.
                        Platform ini menjadi solusi untuk menciptakan lingkungan belajar kolaboratif yang efektif.
                    </p>
                    <ul class="space-y-3 text-teal-700">
                        <li class="flex items-center gap-3">
                            <span
                                class="w-6 h-6 bg-teal-500 rounded-full flex items-center justify-center text-white text-sm">✓</span>
                            Mengatasi isolasi dalam belajar mandiri
                        </li>
                        <li class="flex items-center gap-3">
                            <span
                                class="w-6 h-6 bg-teal-500 rounded-full flex items-center justify-center text-white text-sm">✓</span>
                            Meningkatkan motivasi melalui peer support
                        </li>
                        <li class="flex items-center gap-3">
                            <span
                                class="w-6 h-6 bg-teal-500 rounded-full flex items-center justify-center text-white text-sm">✓</span>
                            Memfasilitasi diskusi dan sharing knowledge
                        </li>
                    </ul>
                </div>

                <!-- Illustration -->
                <div class="order-1 lg:order-2 flex justify-center">
                    <div class="relative">
                        <div
                            class="w-80 h-80 bg-gradient-to-br from-teal-400 to-green-500 rounded-3xl flex items-center justify-center">
                            <span class="text-8xl">👥</span>
                        </div>
                        <div
                            class="absolute -top-4 -right-4 w-20 h-20 bg-yellow-400 rounded-full flex items-center justify-center">
                            <span class="text-3xl">💡</span>
                        </div>
                        <div
                            class="absolute -bottom-4 -left-4 w-16 h-16 bg-orange-400 rounded-full flex items-center justify-center">
                            <span class="text-2xl">📚</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Technology Stack -->
    <div class="bg-teal-800 py-20">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Teknologi Modern</h2>
            <p class="text-xl text-teal-100 mb-12">Dibangun dengan teknologi terdepan untuk performa optimal</p>

            <div class="grid grid-cols-3 gap-8">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-colors duration-200">
                    <div class="text-4xl mb-4">🐘</div>
                    <h3 class="text-white font-bold text-lg">Laravel</h3>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-colors duration-200">
                    <div class="text-4xl mb-4">🗄️</div>
                    <h3 class="text-white font-bold text-lg">MySQL</h3>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-colors duration-200">
                    <div class="text-4xl mb-4">🎨</div>
                    <h3 class="text-white font-bold text-lg">Tailwind</h3>
                </div>
            </div>

        </div>
    </div>

    <!-- Team Section -->
    <div class="bg-gradient-to-br from-teal-50 to-green-50 py-20">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-teal-800 mb-6">Kelompok A</h2>
            <p class="text-xl text-teal-600 mb-12">Tim developer yang berdedikasi untuk menciptakan solusi pembelajaran
                terbaik</p>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-200">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl text-white">👨‍💻</span>
                    </div>
                    <h3 class="font-bold text-teal-800 text-lg mb-2">Cornelius Rizki Pratama</h3>
                    <p class="text-xs text-teal-500">(045028769)</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-200">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl text-white">👩‍💻</span>
                    </div>
                    <h3 class="font-bold text-teal-800 text-lg mb-2">Helda Ramadiah Fitri</h3>
                    <p class="text-xs text-teal-500">(043951375)</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-200">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-orange-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl text-white">👨‍💻</span>
                    </div>
                    <h3 class="font-bold text-teal-800 text-lg mb-2">Nadila Rizky Amelia</h3>
                    <p class="text-xs text-teal-500">(048434676)</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-200">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl text-white">👨‍💻</span>
                    </div>
                    <h3 class="font-bold text-teal-800 text-lg mb-2">Rulan Antula</h3>
                    <p class="text-xs text-teal-500">(044313651)</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-200">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl text-white">👨‍💻</span>
                    </div>
                    <h3 class="font-bold text-teal-800 text-lg mb-2">Selvy Tuamain</h3>
                    <p class="text-xs text-teal-500">(045305166)</p>
                </div>
            </div>

        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-br from-teal-600 to-green-700 py-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Siap Memulai Perjalanan Belajar?</h2>
            <p class="text-xl text-teal-100 mb-8">
                Bergabunglah dengan komunitas mahasiswa yang produktif dan saling mendukung
            </p>

            @guest
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <div class="relative group">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-2xl blur opacity-75 group-hover:opacity-100 transition duration-200">
                        </div>
                        <a href="{{ route('register') }}"
                            class="relative bg-white text-teal-700 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center gap-2">
                            <span class="text-xl">🚀</span>
                            Mulai Sekarang - Gratis!
                        </a>
                    </div>
                </div>
            @endguest
        </div>
    </div>
@endsection
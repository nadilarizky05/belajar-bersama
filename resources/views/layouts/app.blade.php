<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BelajarBersama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'teal-custom': '#4FD1C7',
                        'green-custom': '#2D5A5A',
                        'green-dark': '#1E3A3A',
                        'yellow-custom': '#F5D547',
                        'orange-custom': '#FF8C42'
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-gradient-to-br from-teal-custom via-teal-300 to-green-300">
    <!-- Navigation -->
    <nav class="bg-green-dark shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-yellow-custom rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-dark" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </div>
                            <span class="text-white text-xl font-bold">BelajarBersama</span>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-8">
                    {{-- <a href="#"
                        class="text-white hover:text-yellow-custom transition-colors duration-200 font-medium">Home</a>
                    <a href="#"
                        class="text-white hover:text-yellow-custom transition-colors duration-200 font-medium">Explore</a>
                    <a href="#"
                        class="text-white hover:text-yellow-custom transition-colors duration-200 font-medium">Create
                        Room</a>
                    @auth
                    <div class="relative">
                        <span class="text-white font-medium">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline ml-4">
                            @csrf
                            <button type="submit"
                                class="bg-orange-custom hover:bg-orange-500 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                Logout
                            </button>
                        </form>
                    </div>
                    @else --}}
                    <a href="{{ route('login') }}"
                        class="bg-yellow-custom hover:bg-yellow-400 text-green-dark px-6 py-2 rounded-lg font-semibold transition-colors duration-200">
                        Login
                    </a>
                    {{-- @endauth --}}
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="max-w-4xl mx-auto px-4 pt-4">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    @yield('content')
</body>

</html>
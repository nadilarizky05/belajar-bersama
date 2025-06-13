<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoom API Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gradient-to-br from-teal-500 via-teal-600 to-green-700 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="text-center text-white mb-8">
                <h1 class="text-4xl font-bold mb-4">🧪 Zoom API Test</h1>
                <p class="text-xl">Test koneksi dan fitur Zoom API</p>
            </div>

            <!-- Test Results -->
            <div id="results" class="bg-white rounded-2xl shadow-2xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-teal-800 mb-6">Test Results</h2>
                <div id="results-content" class="text-gray-600">
                    Klik tombol di bawah untuk memulai test...
                </div>
            </div>

            <!-- Test Buttons -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Test Connection -->
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h3 class="font-bold text-teal-800 mb-4">🔗 Test Connection</h3>
                    <p class="text-gray-600 mb-4">Test apakah credentials Zoom valid dan dapat terkoneksi ke API</p>
                    <button id="testConnection"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold transition-colors duration-200">
                        Test Connection
                    </button>
                </div>

                <!-- Test Create Meeting -->
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <h3 class="font-bold text-teal-800 mb-4">📹 Test Create Meeting</h3>
                    <p class="text-gray-600 mb-4">Test pembuatan meeting baru dengan Zoom API</p>
                    <button id="testCreateMeeting"
                        class="w-full bg-green-500 hover:bg-green-600 text-white py-3 px-6 rounded-lg font-semibold transition-colors duration-200">
                        Create Test Meeting
                    </button>
                </div>
            </div>

            <!-- Configuration Info -->
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 mt-8 text-white">
                <h3 class="font-bold mb-4">📋 Configuration Check</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <strong>Account ID:</strong><br>
                        <code
                            class="bg-black/20 px-2 py-1 rounded">{{ config('services.zoom.account_id') ? 'Configured ✅' : 'Missing ❌' }}</code>
                    </div>
                    <div>
                        <strong>Client ID:</strong><br>
                        <code
                            class="bg-black/20 px-2 py-1 rounded">{{ config('services.zoom.client_id') ? 'Configured ✅' : 'Missing ❌' }}</code>
                    </div>
                    <div>
                        <strong>Client Secret:</strong><br>
                        <code
                            class="bg-black/20 px-2 py-1 rounded">{{ config('services.zoom.client_secret') ? 'Configured ✅' : 'Missing ❌' }}</code>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-8">
                <a href="{{ route('rooms.index') }}"
                    class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-lg font-semibold transition-colors duration-200">
                    ← Back to Rooms
                </a>
            </div>
        </div>
    </div>

    <script>
        // CSRF Token setup
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Helper function to show results
        function showResult(title, data, isSuccess = true) {
            const resultsContent = document.getElementById('results-content');
            const statusIcon = isSuccess ? '✅' : '❌';
            const statusColor = isSuccess ? 'text-green-600' : 'text-red-600';

            resultsContent.innerHTML = `
                <div class="border-l-4 ${isSuccess ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50'} p-4 mb-4">
                    <h3 class="font-bold ${statusColor} mb-2">${statusIcon} ${title}</h3>
                    <pre class="text-sm text-gray-700 whitespace-pre-wrap overflow-x-auto">${JSON.stringify(data, null, 2)}</pre>
                </div>
            `;
        }

        function showLoading(message) {
            const resultsContent = document.getElementById('results-content');
            resultsContent.innerHTML = `
                <div class="text-center py-8">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-teal-500 mx-auto mb-4"></div>
                    <p class="text-gray-600">${message}</p>
                </div>
            `;
        }

        // Test Connection
        document.getElementById('testConnection').addEventListener('click', async function () {
            showLoading('Testing Zoom API connection...');

            try {
                const response = await fetch('/test-zoom/connection', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    }
                });

                const data = await response.json();
                showResult('Connection Test', data, data.success);

            } catch (error) {
                showResult('Connection Test Error', { error: error.message }, false);
            }
        });

        // Test Create Meeting
        document.getElementById('testCreateMeeting').addEventListener('click', async function () {
            showLoading('Creating test meeting...');

            try {
                const response = await fetch('/test-zoom/create-meeting', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    }
                });

                const data = await response.json();
                showResult('Create Meeting Test', data, data.success);

            } catch (error) {
                showResult('Create Meeting Test Error', { error: error.message }, false);
            }
        });
    </script>
</body>

</html>
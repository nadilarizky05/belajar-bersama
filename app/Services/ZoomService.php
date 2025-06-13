<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class ZoomService
{
    private $client;
    private $accountId;
    private $clientId;
    private $clientSecret;
    private $accessToken;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 30,
            'verify' => false, // Only for development - enable in production
            'http_errors' => false,
            'curl' => [
                CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            ]
        ]);
        
        $this->accountId = config('services.zoom.account_id');
        $this->clientId = config('services.zoom.client_id');
        $this->clientSecret = config('services.zoom.client_secret');
        
        Log::info('Zoom Service Initialized', [
            'account_id_exists' => !empty($this->accountId),
            'client_id_exists' => !empty($this->clientId),
            'client_secret_exists' => !empty($this->clientSecret),
        ]);
    }

    /**
     * Get access token menggunakan Server-to-Server OAuth
     */
    private function getAccessToken()
    {
        if ($this->accessToken) {
            return $this->accessToken;
        }

        if (empty($this->accountId) || empty($this->clientId) || empty($this->clientSecret)) {
            throw new \Exception('Zoom credentials are not properly configured.');
        }

        try {
            $authHeader = 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret);
            
            Log::info('Attempting Zoom OAuth', [
                'url' => 'https://zoom.us/oauth/token',
                'account_id_preview' => substr($this->accountId, 0, 8) . '...',
            ]);

            $response = $this->client->post('https://zoom.us/oauth/token', [
                'headers' => [
                    'Authorization' => $authHeader,
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'User-Agent' => 'StudyRoom-Laravel-App/1.0',
                ],
                'form_params' => [
                    'grant_type' => 'account_credentials',
                    'account_id' => $this->accountId,
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();
            
            Log::info('Zoom OAuth Response', [
                'status_code' => $statusCode,
                'response' => $responseBody
            ]);

            if ($statusCode !== 200) {
                throw new \Exception("HTTP {$statusCode}: {$responseBody}");
            }

            $data = json_decode($responseBody, true);
            
            if (!$data || !isset($data['access_token'])) {
                throw new \Exception('Invalid response format: ' . $responseBody);
            }

            $this->accessToken = $data['access_token'];
            
            Log::info('Zoom OAuth Success');
            
            return $this->accessToken;
            
        } catch (\Exception $e) {
            Log::error('Zoom OAuth Error', [
                'message' => $e->getMessage(),
                'account_id_preview' => substr($this->accountId ?? '', 0, 8) . '...',
                'client_id_preview' => substr($this->clientId ?? '', 0, 8) . '...',
            ]);
            
            throw new \Exception('Failed to get Zoom access token: ' . $e->getMessage());
        }
    }

    /**
     * Create Zoom meeting
     */
    public function createMeeting($topic, $duration = 60, $startTime = null)
    {
        try {
            $accessToken = $this->getAccessToken();
            
            if (!$startTime) {
                $startTime = now()->toISOString();
            }

            $meetingData = [
                'topic' => $topic,
                'type' => 2, // Scheduled meeting
                'start_time' => $startTime,
                'duration' => $duration,
                'timezone' => 'Asia/Jakarta',
                'settings' => [
                    'host_video' => true,
                    'participant_video' => true,
                    'join_before_host' => true,
                    'mute_upon_entry' => false,
                    'watermark' => false,
                    'use_pmi' => false,
                    'approval_type' => 2, // Automatically approve
                    'audio' => 'both',
                    'auto_recording' => 'none',
                    'waiting_room' => false // Disable waiting room for easier access
                ]
            ];

            Log::info('Creating Zoom Meeting', [
                'topic' => $topic,
                'meeting_data' => $meetingData
            ]);

            $response = $this->client->post('https://api.zoom.us/v2/users/me/meetings', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                    'User-Agent' => 'StudyRoom-Laravel-App/1.0',
                ],
                'json' => $meetingData
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();
            
            Log::info('Zoom Create Meeting Response', [
                'status_code' => $statusCode,
                'response' => $responseBody
            ]);

            if ($statusCode !== 201) {
                Log::error('Zoom API Error', [
                    'status_code' => $statusCode,
                    'response' => $responseBody
                ]);
                throw new \Exception("Zoom API Error HTTP {$statusCode}: {$responseBody}");
            }

            $meeting = json_decode($responseBody, true);

            if (!$meeting || !isset($meeting['id'])) {
                throw new \Exception('Invalid meeting response format');
            }

            $result = [
                'meeting_id' => (string)$meeting['id'], // Ensure it's a string
                'join_url' => $meeting['join_url'],
                'password' => $meeting['password'] ?? null,
                'start_url' => $meeting['start_url'],
                'topic' => $meeting['topic']
            ];

            Log::info('Zoom Meeting Created Successfully', $result);

            return $result;

        } catch (\Exception $e) {
            Log::error('Zoom Create Meeting Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Only return dummy data if explicitly in development mode
            if (config('app.env') === 'local' && config('app.debug')) {
                Log::warning('Returning dummy Zoom data for development');
                return [
                    'meeting_id' => (string)rand(1000000000, 9999999999), // 10-digit number as string
                    'join_url' => 'https://zoom.us/j/' . rand(1000000000, 9999999999),
                    'password' => 'dev123',
                    'start_url' => 'https://zoom.us/s/' . rand(1000000000, 9999999999),
                    'topic' => $topic
                ];
            }
            
            throw $e; // Re-throw the exception for production
        }
    }

    /**
     * Get meeting info
     */
    public function getMeeting($meetingId)
    {
        try {
            $accessToken = $this->getAccessToken();

            Log::info('Getting Zoom Meeting', ['meeting_id' => $meetingId]);

            $response = $this->client->get("https://api.zoom.us/v2/meetings/{$meetingId}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();
            
            Log::info('Zoom Get Meeting Response', [
                'status_code' => $statusCode,
                'meeting_id' => $meetingId
            ]);

            if ($statusCode !== 200) {
                Log::error('Failed to get Zoom meeting', [
                    'meeting_id' => $meetingId,
                    'status_code' => $statusCode,
                    'response' => $responseBody
                ]);
                return null;
            }

            return json_decode($responseBody, true);
            
        } catch (\Exception $e) {
            Log::error('Zoom Get Meeting Error', [
                'meeting_id' => $meetingId,
                'message' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Delete meeting
     */
    public function deleteMeeting($meetingId)
    {
        try {
            $accessToken = $this->getAccessToken();

            Log::info('Deleting Zoom Meeting', ['meeting_id' => $meetingId]);

            $response = $this->client->delete("https://api.zoom.us/v2/meetings/{$meetingId}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $success = $statusCode === 204;
            
            Log::info('Zoom Delete Meeting Response', [
                'meeting_id' => $meetingId,
                'status_code' => $statusCode,
                'success' => $success
            ]);

            return $success;
            
        } catch (\Exception $e) {
            Log::error('Zoom Delete Meeting Error', [
                'meeting_id' => $meetingId,
                'message' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Test connection to Zoom API
     */
    public function testConnection()
    {
        try {
            $accessToken = $this->getAccessToken();
            
            $response = $this->client->get('https://api.zoom.us/v2/users/me', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();
            
            Log::info('Zoom Connection Test', [
                'status_code' => $statusCode,
                'success' => $statusCode === 200
            ]);

            return [
                'success' => $statusCode === 200,
                'status_code' => $statusCode,
                'response' => json_decode($responseBody, true)
            ];
            
        } catch (\Exception $e) {
            Log::error('Zoom Connection Test Failed', [
                'message' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
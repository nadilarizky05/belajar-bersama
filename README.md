# BelajarBersama Laravel Application

Aplikasi BelajarBersama sederhana yang terinspirasi dari StudyStream untuk virtual co-working/body doubling dengan integrasi Zoom API.

## Fitur Utama

✅ **User Authentication** (Register/Login)  
✅ **Create Study Room** dengan auto-generate Zoom meeting  
✅ **Join Room** yang sudah dibuat orang lain  
✅ **Real-time Participant Counter**  
✅ **Room Management** (view, join, leave)  
✅ **Responsive Design**  

## Quick Setup

### 1. Install Laravel Project
```bash
composer create-project laravel/laravel studyroom-app
cd studyroom-app
composer require guzzlehttp/guzzle
```

### 2. Database Setup
```bash
# Buat database 'studyroom_app' di MySQL
# Copy semua migration files ke database/migrations/
php artisan migrate
```

### 3. Environment Configuration
Tambahkan ke `.env`:
```env
# Zoom API (opsional untuk testing)
ZOOM_API_KEY=your_zoom_api_key
ZOOM_API_SECRET=your_zoom_api_secret  
ZOOM_JWT_TOKEN=your_zoom_jwt_token

# Database
DB_DATABASE=studyroom_app
```

### 4. Copy All Files
- Models → `app/Models/`
- Controllers → `app/Http/Controllers/`
- Services → `app/Services/`  
- Views → `resources/views/`
- Routes → `routes/web.php`
- Config → `config/services.php`

### 5. Run Application
```bash
php artisan serve
```

Buka: `http://localhost:8000`

## Cara Penggunaan

### 1. Register/Login
- Kunjungi `/register` untuk buat akun baru
- Atau `/login` jika sudah punya akun

### 2. Create Room
- Klik "Create Your Room"
- Isi nama room, subject (opsional), description
- Sistem otomatis generate Zoom meeting link
- Room langsung aktif dan bisa di-join orang lain

### 3. Join Room
- Di halaman utama, lihat semua room yang aktif
- Klik "Join" untuk masuk ke Zoom meeting
- Participant counter otomatis update

### 4. Room Features
- Lihat detail room dan participants
- Copy Zoom link untuk share
- Leave room ketika selesai

## Zoom API Setup (Opsional)

Untuk production, daftar Zoom Developer Account:

1. Buat akun di [Zoom Marketplace](https://marketplace.zoom.us/)
2. Buat "JWT App" baru
3. Copy API Key, Secret, dan JWT Token ke `.env`

**Catatan**: Jika tidak setup Zoom API, sistem akan generate dummy meeting data untuk testing.

## File Structure

```
app/
├── Http/Controllers/
│   ├── AuthController.php          # Login/Register
│   └── StudyRoomController.php     # Room CRUD & Join
├── Models/
│   ├── StudyRoom.php              # Room model
│   └── RoomParticipant.php        # Participant tracking
└── Services/
    └── ZoomService.php            # Zoom API integration

resources/views/
├── layouts/app.blade.php          # Main layout
├── auth/                          # Login/Register forms
├── rooms/                         # Room views
│   ├── index.blade.php           # Room list
│   ├── create.blade.php          # Create room form
│   └── show.blade.php            # Room details
└── welcome.blade.php             # Landing page
```

## Database Schema

### study_rooms
- `name` - Room name
- `subject` - Study subject (optional)
- `zoom_meeting_id` - Zoom meeting ID
- `zoom_join_url` - Zoom join URL
- `participant_count` - Active participants
- `creator_id` - Room creator

### room_participants  
- `room_id` - FK to study_rooms
- `user_id` - FK to users
- `joined_at` - Join timestamp
- `left_at` - Leave timestamp (nullable)

## Customization Ideas

- **Timer/Pomodoro**: Tambah timer feature
- **Categories**: Filter rooms by subject
- **Chat**: Real-time chat dalam room
- **Statistics**: Track study time
- **Notifications**: Alert ketika ada room baru
- **Google Meet**: Alternative ke Zoom

## Troubleshooting

**Error Zoom API**: Pastikan JWT token valid dan tidak expired  
**Room tidak muncul**: Check `is_active = true` di database  
**Join gagal**: Pastikan user sudah login  
**Migration error**: Pastikan foreign key constraints benar

**MVP Ready!** 🚀 

Aplikasi ini sudah siap untuk testing dan development lanjutan. Core features (create room + generate Zoom + join room) sudah berfungsi dengan baik.

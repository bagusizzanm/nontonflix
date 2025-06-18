# 🎬 NontonFlix - Streaming Platform Laravel 11

NontonFlix adalah platform streaming berbasis web yang dibangun dengan Laravel 11 dan dilengkapi fitur autentikasi, langganan membership, serta integrasi dengan Midtrans untuk pembayaran. Dirancang untuk menyediakan konten video berbayar.

---

## 🛠️ Teknologi yang Digunakan

| Teknologi         | Deskripsi                         |
| ----------------- | --------------------------------- |
| Laravel 11        | Backend Framework utama           |
| Laravel Fortify   | Autentikasi dan manajemen session |
| Midtrans API      | Integrasi sistem pembayaran       |
| MySQL             | Database relasional               |
| Blade Template    | Tampilan frontend dinamis         |
| Laravel Scheduler | Penjadwalan tugas otomatis        |
| Mail (SMTP)       | Pengiriman notifikasi email       |

---

## 🚀 Fitur Utama

- ✅ **Autentikasi dan Registrasi** menggunakan Laravel Fortify.
- 💬 **Notifikasi Email** otomatis saat membership berakhir.
- ⏱ **Scheduled Job** untuk memeriksa dan mengatur status langganan.
- 💳 **Integrasi Payment Gateway** Midtrans (Snap & callback).
- 🎥 **Manajemen Film dan Kategori.**
- 📊 **Sistem Rating Film.**
- 🛡 **Pembatasan Akses Limit Device.**
- 🔐 Middleware kustom seperti `CheckDeviceLimit` dan `LogoutDevice`

---

## 📁 Struktur Folder Penting

```
.
├── app/
│ ├── Actions/Fortify/ # Kustomisasi login & register Fortify
│ ├── Events/ # Event membership kadaluarsa
│ ├── Http/Controllers/ # Movie, Category, Subscription, etc
│ ├── Http/Middleware/ # Middleware custom untuk perangkat
│ ├── Jobs/ # Penjadwalan dan notifikasi
│ ├── Listeners
│ ├── Mail
│ ├── Models/ # User, Movie, Plan, etc
│ ├── Providers/ # Service & Fortify provider
│ └── Services/ # Logika device limit
│ └── View/
├── resources/views/ # Blade templates
└── routes/
├── web.php
└── api.php
```

---

## 📦 Library & Dependency Tambahan

- `laravel/fortify : ` Autentikasi headless
- `midtrans/midtrans-php : ` - Payment gateway Snap API

---

## 🛠️ Instalasi & Setup

1. Clone repository
   ```bash
   git clone https://github.com/bagusizzanm/nontonflix.git
   cd nontonflix
   ```
2. Install dependency
   ```bash
   composer install
   npm install && npm run dev
   ```
3. Setup environment
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Set konfigurasi database di .env
   ```bash
   DB_DATABASE=nontonflix
   DB_USERNAME=root
   DB_PASSWORD=
   ```
5. Migrasi dan Seeder
   ```bash
   php artisan migrate --seed
   ```
6. Konfigurasi Notifikasi Email

   ```
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=1025
   MAIL_USERNAME=null
   MAIL_PASSWORD=null
   MAIL_ENCRYPTION=null
   MAIL_FROM_ADDRESS="hello@example.com"
   MAIL_FROM_NAME="${APP_NAME}"

   ```

## 📅 Scheduled Job

Aplikasi ini memiliki scheduler untuk memeriksa status langganan setiap hari.

Tambahkan ini ke cron di server:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## 💳 Pembayaran (Midtrans Integration)

- Pastikan MIDTRANS_SERVER_KEY dan MIDTRANS_CLIENT_KEY diset di .env.

- Implementasi menggunakan Snap Redirect & Callback. File terkait: TransactionController.php, api.php.

## 🔐 Middleware Kustom

- CheckDeviceLimit: Membatasi jumlah perangkat aktif pengguna.

- LogoutDevice: Menghapus perangkat saat logout.

- DeviceLimitService: Manajemen ID perangkat unik.

## 📬 Notifikasi

**Notifikasi akan dikirim melalui email saat:**

- Membership pengguna berakhir.

- Transaksi berhasil atau gagal.

- File terkait: MembershipNotificationExpired.php, Event MembershipHasExpired.php

# 🎬 NontonFlix – Platform Streaming Video Profesional

**NontonFlix** adalah platform streaming video berbasis web yang dibangun dengan Laravel 11. Platform ini menyediakan fitur langganan premium, autentikasi aman, serta integrasi dengan sistem pembayaran menggunakan Midtrans. Cocok untuk pengembangan produk digital, MVP startup, maupun proyek skala profesional.

---

## 🚀 Fitur Utama

- 🔐 **Autentikasi Aman** menggunakan Laravel Fortify
- 💳 **Sistem Langganan** dengan integrasi **Midtrans Payment Gateway**
- 🧠 **Manajemen User & Middleware** berbasis role & langganan
- 🗄️ **Database**: MySQL
- 📬 **Email Notifikasi** (berlangganan, pembayaran, dll.)
- 🛠️ **Command Jobs & Scheduler** untuk eksekusi otomatisasi (tagihan, reminder, dll.)
- 📺 **Streaming Konten Video**

---

## 🛠️ Teknologi yang Digunakan

| Teknologi         | Deskripsi                         |
|-------------------|-----------------------------------|
| Laravel 11        | Backend Framework utama           |
| Laravel Fortify   | Autentikasi dan manajemen sesi    |
| Midtrans API      | Integrasi sistem pembayaran       |
| MySQL             | Database relasional               |
| Blade Template    | Tampilan frontend dinamis         |
| Laravel Scheduler | Penjadwalan tugas otomatis        |
| Mail (SMTP)       | Pengiriman notifikasi email       |

---

## 📂 Struktur Proyek (Ringkasan)

```
app/
├── Console/Commands     # Custom command untuk scheduler
├── Http/
│   ├── Controllers/     # Controller utama
│   ├── Middleware/      # Proteksi akses user
├── Jobs/                # Background job processing
routes/
├── web.php              # Routing utama aplikasi
resources/
├── views/               # Blade templates
config/
├── fortify.php          # Konfigurasi Fortify
```

---

## ⚙️ Instalasi & Setup

1. **Clone Repository**
```bash
git clone https://github.com/username/nontonflix.git
cd nontonflix
```

2. **Instalasi Dependency**
```bash
composer install
npm install && npm run dev
```

3. **Konfigurasi Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Migrasi Database**
```bash
php artisan migrate
```

5. **Jalankan Server**
```bash
php artisan serve
```

---

## 💳 Integrasi Midtrans

- Daftarkan akun di [https://midtrans.com](https://midtrans.com)
- Ambil **Server Key** dan **Client Key**
- Tambahkan pada file `.env`:
```
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
```

---

## 📅 Scheduler & Jobs

Tambahkan cron berikut di server untuk menjalankan scheduler:

```
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

---

## 📫 Notifikasi Email

- Konfigurasikan `.env` Anda:
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

---

## 🙌 Kontribusi

Pull request sangat diterima. Untuk perubahan besar, silakan buka *issue* terlebih dahulu untuk didiskusikan.

---

## 📄 Lisensi

MIT License © 2025 Muhammad Bagus Izzan Muafy

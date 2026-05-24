# ER Diagram — Penjelasan Relasi Database Kampung Adat Bajulan

## Cara Membaca Notasi Chen

Diagram ER ini menggunakan **Notasi Chen** dengan simbol:

| Simbol | Bentuk | Keterangan |
|--------|--------|------------|
| **Entitas** | Kotak (Rectangle) | Tabel/objek utama dalam database |
| **Relasi** | Diamond (Belah Ketupat) | Hubungan antar entitas |
| **Atribut** | Oval (Ellipse) | Kolom/field dari sebuah entitas |
| **PK** | Oval dengan teks bergaris bawah | Primary Key |

### Kardinalitas

Angka di ujung garis penghubung menunjukkan **kardinalitas** (jumlah keterlibatan):

```
ENTITAS_A (1) ──◇ nama_relasi ◇── (N) ENTITAS_B
```

- **1** → satu
- **N** → banyak (many)

> **Cara baca:** *"Satu [Entitas A] dapat berelasi dengan banyak [Entitas B]"*

---

## Daftar Relasi

### 1. `creates_package` — USERS → PACKAGES

```
USERS (1) ──◇ creates_package ◇── (N) PACKAGES
```

**Kardinalitas:** One-to-Many (1:N)

**Penjelasan:**
Satu user (admin/pengelola) dapat membuat banyak paket wisata, tetapi setiap paket wisata hanya dibuat oleh satu user.

**Kolom penghubung:** `packages.created_by → users.id`

---

### 2. `creates_event` — USERS → EVENTS

```
USERS (1) ──◇ creates_event ◇── (N) EVENTS
```

**Kardinalitas:** One-to-Many (1:N)

**Penjelasan:**
Satu user (admin/pengelola) dapat membuat banyak event, tetapi setiap event hanya dibuat oleh satu user.

**Kolom penghubung:** `events.created_by → users.id`

---

### 3. `uploads_gallery` — USERS → GALLERIES

```
USERS (1) ──◇ uploads_gallery ◇── (N) GALLERIES
```

**Kardinalitas:** One-to-Many (1:N)

**Penjelasan:**
Satu user dapat mengupload banyak foto ke galeri, tetapi setiap foto galeri hanya diupload oleh satu user.

**Kolom penghubung:** `galleries.uploaded_by → users.id`

---

### 4. `authenticates` — USERS → PERSONAL_ACCESS_TOKENS

```
USERS (1) ──◇ authenticates ◇── (N) PERSONAL_ACCESS_TOKENS
```

**Kardinalitas:** One-to-Many (1:N)

**Penjelasan:**
Satu user dapat memiliki banyak token akses (misalnya login dari beberapa perangkat sekaligus), tetapi setiap token hanya dimiliki oleh satu user. Relasi ini bersifat **polymorphic** melalui kolom `tokenable_type` dan `tokenable_id`.

**Kolom penghubung:** `personal_access_tokens.tokenable_id → users.id`

---

### 5. `has_images` — PACKAGES → PACKAGE_IMAGES

```
PACKAGES (1) ──◇ has_images ◇── (N) PACKAGE_IMAGES
```

**Kardinalitas:** One-to-Many (1:N)

**Penjelasan:**
Satu paket wisata dapat memiliki banyak foto, tetapi setiap foto hanya milik satu paket wisata. Salah satu foto dapat ditandai sebagai cover (`is_cover = true`).

**Kolom penghubung:** `package_images.package_id → packages.id`

---

### 6. `has_events` — PACKAGES → EVENTS

```
PACKAGES (1) ──◇ has_events ◇── (N) EVENTS
```

**Kardinalitas:** One-to-Many (1:N)

**Penjelasan:**
Satu paket wisata dapat memiliki banyak event terkait, tetapi setiap event hanya terkait ke satu paket wisata. Kolom `package_id` pada tabel events bersifat **nullable**, artinya event bisa berdiri sendiri tanpa paket.

**Kolom penghubung:** `events.package_id → packages.id`

---

### 7. `booked_via` — PACKAGES → BOOKINGS

```
PACKAGES (1) ──◇ booked_via ◇── (N) BOOKINGS
```

**Kardinalitas:** One-to-Many (1:N)

**Penjelasan:**
Satu paket wisata dapat dipesan berkali-kali oleh banyak tamu, tetapi setiap booking hanya untuk satu paket wisata.

**Kolom penghubung:** `bookings.package_id → packages.id`

---

### 8. `linked_to` — EVENTS → BOOKINGS

```
EVENTS (1) ──◇ linked_to ◇── (N) BOOKINGS
```

**Kardinalitas:** One-to-Many (1:N)

**Penjelasan:**
Satu event dapat dikaitkan ke banyak booking, tetapi setiap booking hanya terkait ke satu event. Kolom `event_id` pada tabel bookings bersifat **nullable**, artinya booking bisa dilakukan tanpa event tertentu.

**Kolom penghubung:** `bookings.event_id → events.id`

---

### 9. `paid_with` — BOOKINGS → PAYMENTS

```
BOOKINGS (1) ──◇ paid_with ◇── (1) PAYMENTS
```

**Kardinalitas:** One-to-One (1:1) ⭐

**Penjelasan:**
Satu booking hanya memiliki tepat satu data pembayaran, dan satu pembayaran hanya untuk satu booking. Ini adalah satu-satunya relasi **one-to-one** dalam sistem ini, ditandai dengan kolom `booking_id` yang bersifat `UNIQUE` pada tabel payments.

**Kolom penghubung:** `payments.booking_id → bookings.id` *(unique)*

---

### 10. `notified_via` — BOOKINGS → WA_NOTIFICATIONS

```
BOOKINGS (1) ──◇ notified_via ◇── (N) WA_NOTIFICATIONS
```

**Kardinalitas:** One-to-Many (1:N)

**Penjelasan:**
Satu booking dapat menghasilkan banyak notifikasi WhatsApp (contoh: notifikasi saat pending, saat pembayaran berhasil, saat mendekati tanggal kunjungan), tetapi setiap notifikasi hanya terkait ke satu booking.

**Kolom penghubung:** `wa_notifications.booking_id → bookings.id`

---

## Ringkasan Semua Relasi

| No | Nama Relasi | Dari | Ke | Kardinalitas | Nullable |
|----|-------------|------|----|:------------:|:--------:|
| 1 | `creates_package` | USERS | PACKAGES | 1 : N | Tidak |
| 2 | `creates_event` | USERS | EVENTS | 1 : N | Tidak |
| 3 | `uploads_gallery` | USERS | GALLERIES | 1 : N | Tidak |
| 4 | `authenticates` | USERS | PERSONAL_ACCESS_TOKENS | 1 : N | Tidak |
| 5 | `has_images` | PACKAGES | PACKAGE_IMAGES | 1 : N | Tidak |
| 6 | `has_events` | PACKAGES | EVENTS | 1 : N | Ya |
| 7 | `booked_via` | PACKAGES | BOOKINGS | 1 : N | Tidak |
| 8 | `linked_to` | EVENTS | BOOKINGS | 1 : N | Ya |
| 9 | `paid_with` | BOOKINGS | PAYMENTS | **1 : 1** | Tidak |
| 10 | `notified_via` | BOOKINGS | WA_NOTIFICATIONS | 1 : N | Tidak |

---

## Catatan Penting

- **Satu-satunya relasi 1:1** adalah `paid_with` antara BOOKINGS dan PAYMENTS, karena setiap booking hanya boleh memiliki satu record pembayaran.
- **Relasi nullable** (`has_events` dan `linked_to`) berarti entitas anak dapat ada tanpa harus terhubung ke entitas induk.
- **USERS** adalah entitas pusat yang terhubung ke PACKAGES, EVENTS, GALLERIES, dan PERSONAL_ACCESS_TOKENS — mencerminkan bahwa semua aktivitas pengelolaan dilakukan oleh user yang terautentikasi.
- **BOOKINGS** adalah entitas paling terhubung, menjadi titik temu antara paket, event, pembayaran, dan notifikasi.

# PRD & Petunjuk Setup Bot WhatsApp Konfirmasi Pemesanan
## Landeuh Village Riverside

**Versi:** 1.0  
**Tujuan:** Menjadi panduan setup bot WhatsApp noreply untuk konfirmasi pemesanan dan keberhasilan reschedule. Alur notifikasi email tetap mengikuti ketentuan pada bagian Alur Bisnis.

---

## 1. Tujuan Sistem

Sistem mengirimkan notifikasi otomatis kepada pelanggan ketika:

1. Pemesanan berhasil dibuat dan pembayaran berhasil diverifikasi.
2. Pengajuan reschedule disetujui dan jadwal pemesanan berhasil diperbarui.

WhatsApp digunakan sebagai kanal **notifikasi satu arah (noreply)**. Pelanggan yang membalas pesan akan menerima balasan otomatis yang mengarahkan mereka ke Admin Customer Service.

> **Catatan implementasi:** Template pesan harus dibuat dan dikelola langsung di provider WhatsApp yang digunakan, bukan dirangkai di controller. Controller/service cukup mengirim permintaan pengiriman template beserta variabelnya sesuai API provider.

## 2. Konfigurasi Nomor dan Peran

| Konfigurasi | Nilai |
|---|---|
| Nama bisnis | Landeuh Village Riverside |
| Nomor pengirim WhatsApp | `+62 856-9281-1221` |
| Format nomor pengirim internasional | `6285692811221` |
| Nomor Admin Customer Service | `+62 857-7901-2797` |
| Format nomor admin untuk tautan WhatsApp | `6285779012797` |
| Tipe pesan | Notifikasi otomatis / noreply |
| Bahasa template | Bahasa Indonesia |

Pastikan nomor pengirim sudah terhubung dan terverifikasi di provider. Nomor pengirim dan nomor admin memiliki fungsi berbeda: nomor pengirim digunakan untuk mengirim notifikasi, sedangkan nomor admin menjadi tujuan konsultasi pelanggan.

## 3. Perilaku Noreply

- Pesan konfirmasi dikirim dari nomor pengirim yang ditentukan.
- Cantumkan keterangan bahwa pesan dibuat otomatis dan balasan tidak dipantau.
- Jika provider mendukung pengaturan **auto-reply untuk pesan masuk**, aktifkan balasan otomatis untuk setiap pesan masuk ke nomor pengirim.
- Auto-reply mengarahkan pelanggan ke nomor Admin Customer Service.
- Jangan mengklaim bahwa nomor benar-benar tidak dapat menerima balasan apabila provider masih menerima pesan masuk. Yang dimaksud noreply adalah balasan tidak dilayani di nomor pengirim.
- Bila provider tidak mendukung auto-reply, gunakan fitur webhook/chatbot/automation provider. Jangan membuat balasan masuk melalui controller aplikasi jika persyaratannya adalah template dan alur chat dikelola langsung di provider.
- Pastikan auto-reply tidak memicu balasan berulang tanpa batas. Idealnya, provider menyediakan aturan anti-loop atau pembatasan frekuensi.

### Catatan footer yang digunakan pada pesan konfirmasi

> ⚠️ Harap jangan membalas pesan ini karena pesan dikirim otomatis dan balasan tidak akan dijawab. Jika ada pertanyaan, silakan hubungi Admin Customer Service melalui tautan WhatsApp yang tercantum di bawah.

Kasih akses nomor admin cs di bawahnya.

## 4. Alur Bisnis

### 4.1 Pemesanan baru berhasil

1. Pelanggan membuat pemesanan.
2. Sistem menunggu sampai status pembayaran benar-benar berhasil diverifikasi.
3. Setelah verifikasi berhasil, sistem mengirim:
   - WhatsApp: template `booking_confirmation`;
   - Email: email konfirmasi pemesanan.
4. Informasi tanggal check-in/check-out, nomor pesanan, total, metode pembayaran, akomodasi, dan invoice harus sesuai dengan data pemesanan yang tersimpan.
5. Jika pengiriman WhatsApp gagal, catat kegagalan di log dan sediakan mekanisme retry yang tidak menyebabkan notifikasi ganda.

**Penting:** Jangan mengirim konfirmasi pembayaran berhasil hanya karena pemesanan dibuat. Pemicu pengiriman harus berupa status pembayaran yang sudah terverifikasi.

### 4.2 Reschedule disetujui

1. Pelanggan mengajukan perubahan tanggal.
2. Pengajuan disimpan sebagai **menunggu persetujuan**. Tanggal pemesanan aktif belum diubah.
3. Admin menyetujui pengajuan.
4. Sistem memvalidasi pengajuan dan menyimpan tanggal baru ke pemesanan aktif secara berhasil.
5. Setelah penyimpanan berhasil, sistem mengirim:
   - WhatsApp: template `booking_reschedule_approved`;
   - Email: email pemberitahuan reschedule berhasil.
6. Semua tanggal yang ditampilkan harus memakai tanggal baru yang telah tersimpan, bukan tanggal pengajuan yang belum tervalidasi.

### 4.3 Reschedule ditolak

1. Admin menolak pengajuan.
2. Status pengajuan diperbarui menjadi **ditolak**.
3. Tanggal check-in/check-out pemesanan aktif tetap memakai tanggal pemesanan awal/terakhir yang telah disetujui.
4. **Jangan mengirim WhatsApp maupun email** untuk penolakan, sesuai kebutuhan saat ini.
5. Jangan menimpa tanggal pemesanan aktif dengan tanggal yang diajukan.

### 4.4 Ringkasan aturan notifikasi

| Peristiwa | WhatsApp | Email | Tanggal yang digunakan |
|---|---|---|---|
| Pembayaran berhasil diverifikasi | Kirim konfirmasi | Kirim konfirmasi | Tanggal pemesanan aktif |
| Reschedule disetujui dan tanggal baru tersimpan | Kirim konfirmasi reschedule | Kirim konfirmasi reschedule | Tanggal baru |
| Reschedule ditolak | Tidak dikirim | Tidak dikirim | Tanggal pemesanan aktif tidak berubah |
| Pengajuan reschedule masih menunggu | Tidak dikirim | Tidak dikirim | Tanggal pemesanan aktif tidak berubah |
| Gagal menyimpan perubahan reschedule | Tidak dikirim | Tidak dikirim | Tanggal pemesanan aktif tidak berubah |

## 5. Template WhatsApp di Provider

Buat template berikut di dashboard provider. Nama template di bawah merupakan nama internal yang disarankan; sesuaikan aturan penamaan dan persetujuan template dengan provider yang digunakan.

### 5.1 Template konfirmasi pemesanan

**Nama template:** `booking_confirmation`  
**Bahasa:** Indonesian  
**Kategori provider:** Utility / Transactional (jika tersedia)  
**Pemicu:** Pembayaran berhasil diverifikasi

**Isi template:**

```text
Halo, {{1}}!

Terima kasih telah melakukan pemesanan di *Landeuh Village Riverside*.

Pembayaran Anda untuk pesanan *{{2}}* telah BERHASIL diverifikasi.

*DETAIL PESANAN*
🏠 Akomodasi: {{3}}
📅 Check-in: {{4}}
🌙 Durasi: {{5}} malam
📅 Check-out: {{6}}
💰 Total: IDR {{7}}
💳 Metode pembayaran: {{8}}

*KEBIJAKAN PEMESANAN*
- Pemesanan ini tidak dapat diubah.
- Pemesanan tidak dapat di-refund apabila Anda membatalkannya.

Silakan unduh E-Ticket/Invoice melalui tautan berikut:
👉 {{9}}

Tunjukkan invoice tersebut atau sebutkan nomor pesanan saat proses check-in.

Pesan ini dibuat otomatis oleh sistem (noreply).
⚠️ Harap jangan membalas pesan ini karena balasan tidak akan dijawab.

Jika ada pertanyaan, silakan hubungi Admin Customer Service:
👉 https://wa.me/6285779012797

Salam hangat,
Tim Landeuh Village Riverside
```

**Pemetaan variabel:**

| Variabel | Nilai dari aplikasi | Contoh |
|---|---|---|
| `{{1}}` | `pemesan_nama` | Budi |
| `{{2}}` | `no_pesanan` | LVR-2026-001 |
| `{{3}}` | Judul akomodasi atau paket perusahaan | Vila Riverside |
| `{{4}}` | `check_in_date`, format tanggal Indonesia | Senin, 2 November 2026 |
| `{{5}}` | `malam` | 2 |
| `{{6}}` | `check_out_date`, format tanggal Indonesia | Rabu, 4 November 2026 |
| `{{7}}` | `total`, format pemisah ribuan Indonesia | 1.500.000 |
| `{{8}}` | `metode_pembayaran` | Transfer Bank |
| `{{9}}` | URL invoice berdasarkan nomor pesanan | URL invoice yang valid |

**Catatan kebijakan:** Pastikan kebijakan tidak dapat diubah dan tidak ada refund benar-benar sesuai ketentuan bisnis yang telah disampaikan kepada pelanggan. Jika kebijakan berbeda berdasarkan produk atau kondisi, gunakan teks kebijakan yang sesuai dan jangan menyatakan aturan universal yang tidak berlaku.

### 5.2 Template reschedule berhasil

**Nama template:** `booking_reschedule_approved`  
**Bahasa:** Indonesian  
**Kategori provider:** Utility / Transactional (jika tersedia)  
**Pemicu:** Reschedule disetujui dan tanggal baru berhasil disimpan

**Isi template:**

```text
Halo, {{1}}!

Pengajuan reschedule untuk pesanan *{{2}}* di *Landeuh Village Riverside* telah DISETUJUI dan berhasil diperbarui.

*JADWAL PEMESANAN TERBARU*
🏠 Akomodasi: {{3}}
📅 Check-in baru: {{4}}
🌙 Durasi: {{5}} malam
📅 Check-out baru: {{6}}

Mohon gunakan jadwal terbaru di atas sebagai acuan saat kedatangan.

Invoice/E-Ticket terbaru dapat diunduh melalui tautan berikut:
👉 {{7}}

Pesan ini dibuat otomatis oleh sistem (noreply).
⚠️ Harap jangan membalas pesan ini karena balasan tidak akan dijawab.

Jika ada pertanyaan, silakan hubungi Admin Customer Service:
👉 https://wa.me/6285779012797

Salam hangat,
Tim Landeuh Village Riverside
```

**Pemetaan variabel:**

| Variabel | Nilai dari aplikasi | Contoh |
|---|---|---|
| `{{1}}` | `pemesan_nama` | Budi |
| `{{2}}` | `no_pesanan` | LVR-2026-001 |
| `{{3}}` | Judul akomodasi atau paket perusahaan | Vila Riverside |
| `{{4}}` | Tanggal check-in terbaru yang sudah tersimpan | Senin, 9 November 2026 |
| `{{5}}` | Durasi malam terbaru | 2 |
| `{{6}}` | Tanggal check-out terbaru yang sudah tersimpan | Rabu, 11 November 2026 |
| `{{7}}` | URL invoice/E-Ticket terbaru | URL invoice yang valid |

**Aturan penting:** Jika invoice memuat tanggal menginap, pastikan invoice menampilkan tanggal terbaru setelah reschedule berhasil. Jika tautan invoice yang sama selalu mengambil data terbaru dari database, tautan yang sama dapat digunakan. Jika invoice berupa file statis, buat ulang file setelah perubahan.

### 5.3 Template auto-reply untuk pesan masuk

**Nama aturan/template:** `noreply_auto_reply`  
**Pemicu:** Pelanggan mengirim pesan masuk ke nomor pengirim  
**Mode:** Auto-reply dari provider, bukan controller aplikasi

**Isi balasan:**

```text
Halo, terima kasih telah menghubungi Landeuh Village Riverside.

Nomor ini hanya untuk notifikasi otomatis dan tidak melayani balasan.

Jika ada pertanyaan, silakan hubungi Admin Customer Service:
👉 https://wa.me/6285779012797

Terima kasih.
Tim Landeuh Village Riverside
```

Jika provider mendukungnya, atur auto-reply agar tidak mengirim balasan berulang untuk setiap pesan dalam rentang waktu yang sangat singkat. Namun, pelanggan tetap harus menerima petunjuk kontak admin ketika mengirim pesan pertama atau ketika aturan provider mengharuskannya.

## 6. Arahan Integrasi Aplikasi

Template pesan berada di provider, tetapi aplikasi tetap perlu mengirim data dinamis ke placeholder template. Rekomendasi implementasi:

1. Buat dan ajukan template WhatsApp di dashboard provider jika memerlukan persetujuan.
2. Simpan kredensial API provider di environment/configuration yang aman; jangan hardcode token API di source code.
3. Buat service pengiriman yang memanggil API provider dengan **nama/ID template** dan **daftar parameter** yang sesuai urutan placeholder.
4. Controller tidak menyusun isi pesan panjang. Controller atau event handler memanggil service dengan konteks pemesanan.
5. Gunakan event/trigger setelah transaksi database berhasil, misalnya:
   - `PaymentVerified` → kirim WhatsApp `booking_confirmation` dan jalankan notifikasi email sesuai alur bisnis.
   - `RescheduleApprovedAndSaved` → kirim WhatsApp `booking_reschedule_approved` dan jalankan notifikasi email sesuai alur bisnis.
6. Untuk reschedule, lakukan validasi dan simpan tanggal baru terlebih dahulu. Kirim notifikasi setelah transaksi penyimpanan berhasil.
7. Gunakan antrean/job untuk pengiriman agar proses checkout/admin tidak terhambat oleh provider.
8. Catat status pengiriman, ID pesan provider, waktu pengiriman, dan kesalahan. Jangan menyimpan token rahasia atau data pembayaran sensitif ke log.
9. Terapkan idempotensi agar event yang sama tidak mengirim konfirmasi berulang. Contoh kunci: `booking_id + event_type + booking_version`.
10. Kegagalan WhatsApp tidak boleh membatalkan pemesanan yang sudah valid. Tandai notifikasi gagal dan sediakan retry.
11. Pastikan tanggal dan nominal diformat sebelum dikirim sebagai parameter template. Gunakan zona waktu dan locale Indonesia yang konsisten.
12. Pastikan URL invoice dapat diakses oleh penerima yang berhak dan tidak membocorkan data pesanan orang lain.

### Contoh data yang perlu dikirim ke provider

Untuk `booking_confirmation`, aplikasi mengirim:
- `template_name`: `booking_confirmation`
- `to`: nomor WhatsApp pelanggan dalam format yang diwajibkan provider
- `parameters`: nama pemesan, nomor pesanan, akomodasi, check-in, durasi, check-out, total, metode pembayaran, URL invoice

Untuk `booking_reschedule_approved`, aplikasi mengirim:
- `template_name`: `booking_reschedule_approved`
- `to`: nomor WhatsApp pelanggan
- `parameters`: nama pemesan, nomor pesanan, akomodasi, check-in terbaru, durasi terbaru, check-out terbaru, URL invoice terbaru

Struktur request, penamaan field, format nomor, dan format parameter harus disesuaikan dengan dokumentasi provider yang benar-benar digunakan. Jangan mengasumsikan semua provider menggunakan format API yang sama.

## 7. Konfigurasi Environment yang Disarankan

Nama variabel berikut bersifat rekomendasi; sesuaikan dengan integrasi yang dipilih.

```dotenv
WA_SENDER_NUMBER=6285692811221
WA_ADMIN_NUMBER=6285779012797
WA_BOOKING_TEMPLATE=booking_confirmation
WA_RESCHEDULE_TEMPLATE=booking_reschedule_approved
WA_NOREPLY_AUTO_REPLY_ENABLED=true
```

Simpan API token/secret provider di environment atau secret manager, misalnya `WA_API_TOKEN`, sesuai kebutuhan provider. Jangan masukkan token ke file yang di-commit ke repository.

## 8. Kriteria Penerimaan (Acceptance Criteria)

- [ ] Konfirmasi WhatsApp hanya dikirim setelah pembayaran berhasil diverifikasi.
- [ ] Pesan dikirim dari nomor `+62 856-9281-1221`.
- [ ] Pesan menyertakan keterangan noreply dan tautan Admin Customer Service `https://wa.me/6285779012797`.
- [ ] Template konfirmasi pemesanan dikelola di provider, bukan dirangkai menjadi pesan panjang di controller.
- [ ] Saat reschedule disetujui, tanggal baru tersimpan dahulu, lalu WhatsApp dikirim dan email reschedule mengikuti alur bisnis.
- [ ] Konfirmasi reschedule menggunakan tanggal check-in/check-out terbaru dari database.
- [ ] Saat reschedule ditolak, tanggal pemesanan aktif tidak berubah dan tidak ada WhatsApp/email penolakan.
- [ ] Saat reschedule masih menunggu, tidak ada notifikasi keberhasilan.
- [ ] Pesan masuk ke nomor pengirim mendapat auto-reply yang mengarahkan ke admin, bila fitur tersebut didukung/dikonfigurasi di provider.
- [ ] Pengiriman gagal tercatat dan dapat dicoba ulang tanpa menghasilkan pesan duplikat.
- [ ] Invoice/E-Ticket menampilkan data terbaru setelah reschedule.
- [ ] Template lolos validasi/persetujuan provider jika provider mewajibkannya.

## 9. Checklist Setup di Dashboard Provider

- [ ] Hubungkan dan verifikasi nomor pengirim `+62 856-9281-1221`.
- [ ] Pastikan nomor tersebut diizinkan untuk mengirim notifikasi.
- [ ] Buat template `booking_confirmation`.
- [ ] Buat template `booking_reschedule_approved`.
- [ ] Buat aturan auto-reply `noreply_auto_reply` untuk pesan masuk.
- [ ] Atur auto-reply agar tidak menimbulkan loop atau spam balasan.
- [ ] Periksa format placeholder dan urutannya.
- [ ] Ajukan template untuk persetujuan jika diwajibkan.
- [ ] Uji dengan nomor pelanggan percobaan.
- [ ] Pastikan nomor admin dan tautan WhatsApp terbuka dengan benar.
- [ ] Uji pemesanan baru, reschedule disetujui, reschedule ditolak, dan kegagalan pengiriman.
- [ ] Pastikan aplikasi mengirim nama/ID template serta parameter, bukan isi pesan yang dirangkai di controller.

## 10. Hal yang Perlu Dikonfirmasi Saat Implementasi

Panduan ini bersifat provider-agnostic karena nama provider WhatsApp belum ditentukan. Sebelum implementasi final, pastikan:
- Provider yang digunakan mendukung template pesan dan pengiriman parameter.
- Provider mendukung auto-reply pesan masuk atau memiliki fitur chatbot/automation/webhook.
- Ketentuan template, kategori pesan, persetujuan, dan biaya mengikuti kebijakan provider yang dipilih.
- Ketentuan pembatalan dan refund yang dicantumkan pada template sesuai dengan kebijakan resmi bisnis.

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PengaduanDikonfirmasi extends Notification
{
    use Queueable;

    protected $pengaduan;

    // Kirim data pengaduan ke notif
    public function __construct($pengaduan)
    {
        $this->pengaduan = $pengaduan;
    }

    /**
     * Channel pengiriman notif
     */
    public function via(object $notifiable): array
    {
        return ['database']; // 📌 notif disimpan ke database, bukan email
    }

    /**
     * Data yang disimpan di tabel notifications
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Pengaduan anda telah dikonfirmasi dan sedang diproses.',
            'pengaduan_id' => $this->pengaduan->id,
            'status' => $this->pengaduan->status,
        ];
    }
}
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StokMenipisNotification extends Notification
{
    use Queueable;

    public $obat;

    public function __construct($obat)
    {
        $this->obat = $obat;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Stok obat '.$this->obat->nama_obat.' menipis!',
            'obat_id' => $this->obat->id
        ];
    }
}
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KegiatanNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $kegiatan;
    public function __construct($kegiatan)
    {
        $this->kegiatan = $kegiatan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'kegiatan_id' => $this->kegiatan->kegiatan_id,
            'user_id' => $this->kegiatan->user_id,
            'title' => 'Kegiatan Baru',
            'message' => $this->kegiatan->nama_kegiatan. ' telah ditambahkan.'
        ];
    }
}

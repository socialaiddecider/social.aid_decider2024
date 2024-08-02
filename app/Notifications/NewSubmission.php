<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Pengajuan;
use App\Models\User;

class NewSubmission extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $pengajuan = Pengajuan::class;
    public $user = User::class;
    public $admin = User::class;
    public function __construct($pengajuan, $admin, $user)
    {
        $this->pengajuan = $pengajuan;
        $this->user = $user;
        $this->admin = $admin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Check this ' . $this->admin->name . '.')
            ->line($this->user->name . ' has submitted a new pengajuan')
            ->action('Check Submission', url('/admin/pengajuan/show/' . $this->pengajuan->id))
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
            //
        ];
    }
}

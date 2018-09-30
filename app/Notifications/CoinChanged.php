<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Coin;

class CoinChanged extends Notification
{
    use Queueable;

    protected $coin;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Coin $coin)
    {
        $this->coin = $coin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        $sign = $this->coin->number > 0 ? '+' : '';
        return [
            'title' => '积分提醒',
            'content' => Coin::$typeMsg[$this->coin->type]['name'] . '，积分' . $sign . $this->coin->number,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

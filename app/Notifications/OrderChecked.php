<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class OrderChecked extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
        $str = $this->order->status == 1 ? '的订单审核通过，' : '的订单审核失败，';
        return [
/*          'order_id' => $this->order->id,
            'order_number' => $this->order->number,
            'order_dealt_at' => $this->order->dealt_at,
            'member_name' => $this->order->member->name,
            'product_name' => $this->order->product->name,
            'status' => $this->order->status == 1 ? '订单审核通过' : '订单审核失败',*/
            'title' => '【订单审核】',
            'content' => $this->order->member->name . $str . '编号：' . $this->order->idnumber . '。',
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

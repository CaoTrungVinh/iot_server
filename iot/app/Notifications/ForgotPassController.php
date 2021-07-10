<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgotPassController extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return ( new MailMessage )
            ->subject( "Cấp mật khẩu mới cho tài khoản hệ thống đo chỉ số nước ao nuôi cá" )
            ->greeting( "Xin chào! " )
            ->line( "Mật khẩu mới của bạn là : " )
            ->line($notifiable->random_key)
            ->line( "Hãy đăng nhập vào hệ thống và đổi lại password." )
            ->line( "Lưu ý: Link có thời gian sử dụng là 12 giờ." )
            ->line( 'Cảm ơn bạn đã sử dụng hệ thống của chúng tôi!!!' );
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

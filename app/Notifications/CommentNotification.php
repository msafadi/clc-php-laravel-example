<?php

namespace App\Notifications;

use App\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommentNotification extends Notification
{
    use Queueable;

    protected $post;

    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        //
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //if ($notifiable->via_email) {
        return ['database'];
        //}
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url(route('post', [ $this->post->slug ]));
        $message = sprintf(
            '%s has commented on your post "%s"',
            $this->user->name,
            $this->post->title
        );

        return (new MailMessage)
                    ->line('Hello ' . $notifiable->name)
                    ->line($message)
                    ->action('View Comment', $url)
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        $url = url(route('post', [ $this->post->slug ]));
        $message = sprintf(
            '%s has commented on your post "%s"',
            $this->user->name,
            $this->post->title
        );

        return [
            'message' => $message,
            'url' => $url,
            //'user' => $this->user,
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

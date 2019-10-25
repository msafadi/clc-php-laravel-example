<?php

namespace App\Notifications;

use App\Channels\TweetSms;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

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
        return ['database'/*, TweetSms::class*/, 'broadcast'];
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
                ->view('mails.notification', [
                    'name' => $notifiable->name,
                    'mail_message' => $message,
                    'action_url' => $url,
                    'action_text' => 'View Comment',
                ]);
                    /*->line('Hello ' . $notifiable->name)
                    ->line($message)
                    ->action('View Comment', $url)
                    ->line('Thank you for using our application!');*/
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

    public function toNexmo($notifiable)
    {
        $content = sprintf(
            '%s has commented on your post',
            $this->user->name
        );

        $message = new NexmoMessage();
        $message->content($content);
        return $message;
    }

    public function toTweetSms($notifiable)
    {
        $message = sprintf(
            '%s has commented on your post',
            $this->user->name
        );
        return $message;
    }

    public function toBroadcast($notifiable)
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
            'time' => (new Carbon())->diffForHumans(),
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

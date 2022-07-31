<?php

namespace MKamelMasoud\Ads\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use MKamelMasoud\Ads\Http\Resources\AdResource;

class ReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $subject;

    public function __construct($subject)
    {
        $this->setsubject($subject);
    }

    public function via($notifiable)
    {
        return ["mail"];
    }

    public function toMail($notifiable)
    {
        logger('ReminderNotification');
        return (new MailMessage)
            ->subject($this->getSubject())
            ->view("ads::mail.reminder", [
                "subject" => $this->getSubject(),
                "user"    => $notifiable,
                "ads"     => AdResource::collection($notifiable->ads),
            ]);
    }

    /**
     * Get the value of subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of subject
     *
     * @return  self
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }
}

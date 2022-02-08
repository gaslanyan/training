<?php

namespace App\Notifications;

use App\Models\Account;
use App\Models\Message;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

/**
 * Class PaymentNotification
 * @package App\Notifications
 */
class PaymentNotification extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    public $user;
    /**
     * @var Account
     */
    public $account;
    /**
     * @var Message
     */
    public $message;

    /**
     * @var
     */
    public $course_name;

    /**
     * @var
     */
    public $data;


    /**
     * PaymentNotification constructor.
     * @param User $user
     * @param Account $account
     * @param Message $message
     * @param $course_name
     * @param $data
     */
    public function __construct(User $user, Account $account, Message $message, $course_name, $data)
    {
        $this->user = $user;
        $this->account = $account;
        $this->message = $message;
        $this->course_name = $course_name;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $load_page = 'mails.payment';
        $pdf = PDF::loadView($load_page,
            ['data' => $this->data,'name'=>$this->course_name])->setPaper('a4', 'landscape')->setWarnings(false);
        $subject = sprintf(config('app.name') ." -- ". $this->message->name);
        $greeting = sprintf('Բարև ' . $this->account->name . " " . $this->account->surname . ', ');
        $mail = (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ->salutation(__("messages.thank_you"))
            ->line(new HtmlString($this->message->value))
        ->attachData($pdf->output(), sprintf('payment_%s.pdf',date('d-m-Y')));

        return $mail;

    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

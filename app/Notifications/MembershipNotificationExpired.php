<?php

namespace App\Notifications;

use App\Mail\MembershipExpiredMail;
use App\Models\Membership;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MembershipNotificationExpired extends Notification
{
  use Queueable;
  private $membership;

  public function __construct($membership)
  {
    $this->membership = $membership;
  }

  public function via(object $notifiable): array
  {
    return ['mail'];
  }


  public function toMail(object $notifiable)
  {
    return (new MembershipExpiredMail($this->membership))
      ->subject('Memberhip Expiration Notification | NontonFlix')
      ->to($notifiable->email)
      ->markdown('mail.membership.expired', [
        'membership' => $this->membership,
        'logo' => asset('assets/img/logo-icon2.png'),
      ]);
    // return (new MailMessage)
    //   ->subject('Memberhip Expiration Notification | NontonFlix')
    //   ->greeting('Hello!')
    //   ->line('Your membership has expired.')
    //   ->line('Expired Date: ' . $this->membership->end_date->format('d M Y'))
    //   ->action('Renew Membership', url('/renew'))
    //   ->line('Thank you for using our application!');
  }

  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}

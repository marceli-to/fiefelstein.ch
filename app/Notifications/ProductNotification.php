<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductNotification extends Notification
{
  use Queueable;

  protected $product;
  protected $email;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct($product, $email)
  {
    $this->product = $product;
    $this->email = $email;
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
    return (new MailMessage)
      ->from(env('MAIL_FROM_ADDRESS'))
      ->replyTo(env('MAIL_REPLY_TO'))
      ->subject('Anfrage Produkt fiefelstein.ch')
      ->markdown('mail.product-notification', ['product' => $this->product, 'email' => $this->email]);
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

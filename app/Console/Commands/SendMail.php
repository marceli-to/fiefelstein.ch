<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderConfirmationNotification;

class SendMail extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'send:mail';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Send notification emails to users';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    try {
      Notification::route('mail', env('MAIL_TO'))
        ->notify(
          new OrderConfirmationNotification([])
        );
    } 
    catch (\Exception $e) {
      \Log::error($e->getMessage());
    }

    $this->info('The command was successful!');
  }
}

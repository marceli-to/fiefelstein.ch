<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Product;
use App\Enums\ProductState;
use App\Actions\Product\FindProduct;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProductNotification as ProductNotificationMail;

class ProductNotification extends Component
{
  public $uuid;
  public $email = '';
  public $product;
  public $hasError = false;

  protected $rules = [
    'email' => 'required|email',
  ];

  protected $messages = [
    'email.required' => 'Bitte E-Mail-Adresse überprüfen.',
    'email.email' => 'Bitte E-Mail-Adresse überprüfen.',
  ];

  public function mount($uuid)
  {
    $this->uuid = $uuid;
    $this->hasError = false;
    $this->product = (new FindProduct())->execute($this->uuid);
  }

  public function submit()
  {
    $this->validate();

    try {
      Notification::route('mail', env('MAIL_TO'))
        ->notify(
          new ProductNotificationMail($this->product, $this->email)
        );
    } 
    catch (\Exception $e) {
      \Log::error($e->getMessage());
    }

    $this->email = '';
    $this->dispatch('hide-submited-form');
    session()->flash('message', 'Danke für Ihre Angaben. Wir halten Sie auf dem Laufenden.');
  }

  public function render()
  {
    return view('livewire.product-notification');
  }
}

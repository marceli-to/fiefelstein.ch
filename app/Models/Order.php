<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
      'uuid',
      'salutation',
      'firstname',
      'name',
      'email',
      'company',
      'street',
      'street_number',
      'zip',
      'city',
      'country',
      'use_invoice_address',
      'shipping_company',
      'shipping_firstname',
      'shipping_name',
      'shipping_street',
      'shipping_street_number',
      'shipping_zip',
      'shipping_city',
      'shipping_country',
      'payment_method',
      'payed_at',
    ];

    public function products()
    {
      return $this->belongsToMany(Product::class, 'order_product')
        ->withPivot('quantity', 'price', 'total')
        ->using(OrderProduct::class);
    }
}

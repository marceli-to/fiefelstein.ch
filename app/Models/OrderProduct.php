<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    protected $fillable = [
      'order_id',
      'product_id',
      'product_variation_id',
      'quantity',
      'price',
      'total'
    ];

    public function order()
    {
      return $this->belongsTo(Order::class);
    }

    public function product()
    {
      return $this->belongsTo(Product::class);
    }

    public function productVariation()
    {
      return $this->belongsTo(ProductVariation::class);
    }
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'name',
    'sort'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function products(): HasMany
  {
    return $this->hasMany(Product::class);
  }
}

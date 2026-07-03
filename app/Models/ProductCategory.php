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
    'sort',
    'is_standalone',
  ];

  protected $casts = [
    'is_standalone' => 'boolean',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function products(): HasMany
  {
    return $this->hasMany(Product::class);
  }

  /**
   * Categories that belong to the main product shop (Produkte overview).
   */
  public function scopeShop($query)
  {
    return $query->where('is_standalone', false);
  }

  /**
   * Standalone categories (e.g. Brocante) shown on their own page and
   * excluded from the main product overview, filters and menu.
   */
  public function scopeStandalone($query)
  {
    return $query->where('is_standalone', true);
  }
}

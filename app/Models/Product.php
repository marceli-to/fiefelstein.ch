<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'group_title',
    'title',
    'description',
    'price',
    'quantity',
    'attributes',
    'cards',
    'image',
    'publish',
    'sort',
    'product_category_id',
    'user_id',
  ];

  protected $casts = [
    'publish' => 'boolean',
    'price' => 'decimal:2',
    'attributes' => 'array',
    'cards' => 'array',
  ];

  /**
   * Get the indexable data array for the model.
   *
   * @return array<string, mixed>
   */
  public function toSearchableArray(): array
  { 
    return [
      'title' => $this->title,
      'description' => $this->description,
      'publish' => $this->publish,
    ];
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(ProductCategory::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function variations(): HasMany
  {
    return $this->hasMany(ProductVariation::class);
  }

  public function scopePublished($query)
  {
    return $query->where('publish', true);
  }
}

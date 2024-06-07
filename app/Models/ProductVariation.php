<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class ProductVariation extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'uuid',
    'title',
    'description',
    'price',
    'quantity',
    'attributes',
    'cards',
    'image',
    'publish',
    'sort',
    'product_id',
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

  public function product(): BelongsTo
  {
    return $this->belongsTo(Product::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

}

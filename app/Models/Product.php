<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\Image\Enums\CropPosition;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
  use SoftDeletes, InteractsWithMedia;

  protected $fillable = [
    'title',
    'description',
    'price',
    'quantity',
    'attributes',
    'cards',
    'publish',
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

  public function attributes(): HasMany
  {
    return $this->hasMany(ProductAttribute::class);
  }

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('preview')->crop(400, 400, CropPosition::Center);
  }

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('product_images');
  }
}

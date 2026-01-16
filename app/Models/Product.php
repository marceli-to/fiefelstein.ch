<?php
namespace App\Models;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Enums\ProductState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
  use SoftDeletes, HasSlug;

  protected $fillable = [
    'uuid',
    'group_title',
    'title',
    'description',
    'price',
    'shipping',
    'stock',
    'attributes',
    'cards',
    'image',
    'publish',
    'state',
    'sort',
    'product_category_id',
    'user_id',
  ];

  protected $casts = [
    'publish' => 'boolean',
    'price' => 'decimal:2',
    'shipping' => 'decimal:2',
    'attributes' => 'array',
    'cards' => 'array',
    'state' => ProductState::class,
  ];

  protected $appends = [
    'isVariation',
    'stateText',
  ];

  /**
   * Get the options for generating the slug.
   */
  public function getSlugOptions(): SlugOptions
  {
    return SlugOptions::create()->generateSlugsFrom('group_title')->saveSlugsTo('slug');
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(ProductCategory::class, 'product_category_id');
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function variations(): HasMany
  {
    return $this->hasMany(ProductVariation::class)->orderBy('sort');
  }

  public function scopePublished($query)
  {
    return $query->where('publish', true);
  }

  public function getRouteKeyName(): string
  {
    return 'slug';
  }

  public function getIsVariationAttribute(): bool
  {
    return false;
  }

  public function getStateTextAttribute(): string
  {
    // if state is 'NotAvailable' return 'Derzeit nicht verfügbar'
    if ($this->state->value == 'not_available') {
      return 'Derzeit nicht verfügbar';
    }

    // if state is 'OnRequest' return 'Auf Anfrage'
    if ($this->state->value == 'on_request') {
      return 'Wird auf Anfrage produziert';
    }

    return $this->state->value;
  }
}

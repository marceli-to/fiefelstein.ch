<?php
namespace App\Models;
use App\Enums\ProductState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariation extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'uuid',
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
    'product_id',
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

  public function product(): BelongsTo
  {
    return $this->belongsTo(Product::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function getIsVariationAttribute(): bool
  {
    return true;
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

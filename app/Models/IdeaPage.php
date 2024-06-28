<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class IdeaPage extends Model
{
  protected $table = 'idea_page';

  protected $fillable = [
    'quote_text',
    'quote_author',
    'text',
    'partner'
  ];

  protected $casts = [
    'partner' => 'array'
  ];
}

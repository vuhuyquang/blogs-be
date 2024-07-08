<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
  use HasFactory;
  protected $table = 'blogs';
  protected $fillable = self::FIELDS;
  public const FIELDS = [
    'title',
    'slug',
    'short_content',
    'content',
    'category_id',
    'author_id',
    'reading_time',
    'image',
  ];

  public function category()
  {
    return $this->hasOne(Category::class, 'id', 'category_id');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'published_at',
        'category_id',
    ];

    protected function casts(): array {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}

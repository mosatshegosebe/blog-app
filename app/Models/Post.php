<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $title
 * @property string $body
 * @property int $user_id
 * @property string $file_location
 * @property int $category_id
 * @property int $published
 */
class Post extends Model
{
    use HasFactory, SoftDeletes;

    const UNPUBLISHED = 0;
    const PUBLISHED = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'file_location',
        'category_id',
        'published',
    ];

    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('published', self::PUBLISHED);
    }
}

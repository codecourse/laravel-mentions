<?php

namespace App\Models;

use App\Observers\CommentObserver;
use Fico7489\Laravel\Pivot\Traits\PivotEventTrait;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(CommentObserver::class)]
class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
    use PivotEventTrait;

    protected $guarded = false;

    public static function booted()
    {
        static::pivotAttached(function ($model, $relationName, $pivotIds) {
            if ($relationName === 'mentions') {
                // notify the user(s)
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mentions()
    {
        return $this->belongsToMany(User::class, 'comments_mentions')
            ->withTimestamps();
    }
}

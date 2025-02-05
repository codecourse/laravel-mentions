<?php

namespace App\Models;

use App\Observers\CommentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(CommentObserver::class)]
class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $guarded = false;

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

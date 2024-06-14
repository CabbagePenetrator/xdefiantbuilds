<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loadout extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gun(): BelongsTo
    {
        return $this->belongsTo(Gun::class);
    }

    public function attachments(): BelongsToMany
    {
        return $this->belongsToMany(Attachment::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function upvotes(): HasMany
    {
        return $this->votes()->where('is_upvote', true);
    }

    public function downvotes(): HasMany
    {
        return $this->votes()->where('is_upvote', false);
    }

    public function scopeByCategory(Builder $query, string $category)
    {
        return $query->whereHas('gun.category', function ($query) use ($category) {
            $query->where('name', $category);
        });
    }
}

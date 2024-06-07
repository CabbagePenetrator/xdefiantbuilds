<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}

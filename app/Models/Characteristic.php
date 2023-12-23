<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Characteristic extends Model
{
    use HasFactory;

    protected $table = 'characteristics';

    protected $fillable = [
        'name',
    ];

    public function names(): BelongsToMany
    {
        return $this->belongsToMany(Name::class);
    }
}

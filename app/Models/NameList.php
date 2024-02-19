<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

/**
 * This class is called NameList and not List because List is a reserved word in PHP.
 */
class NameList extends Model
{
    use HasFactory, Searchable;

    protected $table = 'lists';

    protected $fillable = [
        'user_id',
        'uuid',
        'name',
        'description',
        'is_public',
        'can_be_modified',
        'is_list_of_favorites',
        'gender',
        'list_category_id',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'can_be_modified' => 'boolean',
        'is_list_of_favorites' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function names(): BelongsToMany
    {
        return $this->belongsToMany(Name::class, 'list_name', 'list_id', 'name_id');
    }

    public function scopeFavorite(Builder $query): void
    {
        $query->where('is_list_of_favorites', 1);
    }
}

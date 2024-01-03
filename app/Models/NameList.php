<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class NameList extends Model
{
    use HasFactory, Searchable;

    protected $table = 'lists';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'is_public',
        'can_be_modified',
        'is_list_of_favorites',
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
}

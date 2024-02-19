<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListCategory extends Model
{
    use HasFactory;

    protected $table = 'list_categories';

    protected $fillable = [
        'name',
        'description',
        'is_serious',
    ];

    protected $casts = [
        'is_serious' => 'boolean',
    ];

    public function nameLists(): HasMany
    {
        return $this->hasMany(NameList::class);
    }
}

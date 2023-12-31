<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Name extends Model
{
    use HasFactory;

    protected $table = 'names';

    protected $fillable = [
        'gender',
        'name',
        'origins',
        'personality',
        'country_of_origin',
        'celebrities',
        'elfic_traits',
        'name_day',
        'litterature_artistics_references',
        'similar_names_in_other_languages',
        'klingon_translation',
        'unisex',
        'syllabes',
        'characteristics',
        'total',
        'page_views',
    ];

    protected $casts = [
        'total' => 'integer',
        'page_views' => 'integer',
        'name' => 'string',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
        ];
    }

    public function nameStatistics(): HasMany
    {
        return $this->hasMany(NameStatistic::class);
    }

    public function mainCharacteristics(): BelongsToMany
    {
        return $this->belongsToMany(Characteristic::class);
    }

    public function lists(): BelongsToMany
    {
        return $this->belongsToMany(NameList::class, 'list_name', 'name_id', 'list_id');
    }
}

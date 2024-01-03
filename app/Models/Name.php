<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Name extends Model
{
    use HasFactory, Searchable;

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
        return $this->belongsToMany(NameList::class, 'list_name');
    }

    /**
     * @return Attribute<string,never>
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $multiavatar = new MultiAvatar;
                $avatar = $multiavatar($this->name, null, null);

                return $avatar;
            }
        );
    }
}

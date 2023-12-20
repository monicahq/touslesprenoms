<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'total',
        'page_views',
    ];

    protected $casts = [
        'total' => 'integer',
        'page_views' => 'integer',
        'name' => 'string',
    ];

    public function nameStatistics(): HasMany
    {
        return $this->hasMany(NameStatistic::class);
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

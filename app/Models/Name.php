<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Name extends Model implements Sitemapable
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
        return $this->belongsToMany(NameList::class, 'list_name', 'name_id', 'list_id');
    }

    public function toSitemapTag(): Url|string|array
    {
        return Url::create(route('name.show', $this))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.1);
    }

    public function getNoteForUser(): ?string
    {
        if (! auth()->check()) {
            return null;
        }

        $note = Note::where('name_id', $this->id)
            ->where('user_id', auth()->id())
            ->first();

        if (! $note) {
            return null;
        }

        return $note->content;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
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
        return $this->belongsToMany(NameList::class, 'list_name', 'name_id', 'list_id')->withPivot('public_note');
    }

    public function toSitemapTag(): Url|string|array
    {
        return Url::create(route('name.show', [
            'id' => $this->id,
            'name' => Str::lower($this->name),
        ]))
            ->setPriority(0.9)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setLastModificationDate($this->updated_at);
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

    /**
     * Scope a query to only include non rares names.
     */
    public function scopeNonRares(Builder $query): void
    {
        $query->where('name', '!=', '_PRENOMS_RARES');
    }

    /**
     * Scope a query to only include male names.
     */
    public function scopeMale(Builder $query): void
    {
        $query->where('gender', 'male');
    }

    /**
     * Scope a query to only include female names.
     */
    public function scopeFemale(Builder $query): void
    {
        $query->where('gender', 'female');
    }

    /**
     * Scope a query to only include unisex names.
     */
    public function scopeUnisex(Builder $query): void
    {
        $query->where('unisex', 1);
    }
}

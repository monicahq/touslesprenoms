<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NameStatistic extends Model
{
    use HasFactory;

    protected $table = 'name_statistics';

    protected $fillable = [
        'name_id',
        'year',
        'count',
    ];

    public function name(): BelongsTo
    {
        return $this->belongsTo(Name::class);
    }
}

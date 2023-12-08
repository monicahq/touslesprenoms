<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'organizations';

    protected $fillable = [
        'name',
        'licence_key',
    ];

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function levels(): HasMany
    {
        return $this->hasMany(Level::class);
    }
}

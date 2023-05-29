<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'projects_id',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'locations_id');
    }

    public function projects(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}


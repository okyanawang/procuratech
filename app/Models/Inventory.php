<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\logInventory;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'amount',
        'price',
        'unit',
    ];

    public function log_inventories(): HasMany
    {
        return $this->hasMany(logInventory::class);
    }
}

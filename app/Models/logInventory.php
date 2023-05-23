<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Inventory;

class logInventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'inventories_id',
    ];

    /**
     * The roles that belong to the logInventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invetories(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}

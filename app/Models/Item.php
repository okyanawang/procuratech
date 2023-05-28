<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Task;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'brand',
        'produsen',
        'stock',
        'tasks_id',
    ];
    /**
     * Get the tasks that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tasks(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'taskName',
        'items_id',
        'tasks_id',
        'status',
        'stock'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'items_id', 'id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'tasks_id', 'id');
    }
}

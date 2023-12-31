<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'description_work',
        'description_inspect',
        'status',
        'image_path_work',
        'image_path_inspect',
        'tasks_id',
        'users_id',
    ];

    /**
     * Get the users that owns the Report
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tasks(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}

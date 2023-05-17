<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
        , 'description'
        , 'project_manager_id'
        , 'registration_date'
        , 'start_date'
        , 'end_date'
        , 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}

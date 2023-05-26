<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'username',
        'email',
        'password',
        'phone_number',
        'address',
        'registration_number',
        'status_kepegawaian',
        'availability_status',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    /**
     * Get the role associated with the user.
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'users_has_projects', 'users_id', 'projects_id');
    }

    /**
     * The tasks that belong to the User
     *
     * @return \Illuminate\Task\Eloquent\Relations\BelongsToMany
     */
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'user_has_tasks', 'users_id', 'tasks_id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
    /**
     * Get all of the reports for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function reports(): HasMany
    // {
    //     return $this->hasMany(Report::class);
    // }

    public function hasRole($role)
    {
        return $this->role === $role;
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Observers\UserObserver;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'birth_date',
        'document_cpf',
        'gender',
        'cellphone',
        'emergency_name',
        'emergency_cellphone',
        'status',
        'role',
        'zip_code',
        'state',
        'city',
        'street',
        'number',
        'neighborhood',
        'complement',
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
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? false, fn ($query, $search) => $query->where('name', 'LIKE', "%$search%"));
    }

    public function childrens(): HasMany
    {
        return $this->hasMany(Children::class);
    }
    
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function isAdmin()
    {
        return $this->role === Role::admin->name;
    }

    public function isTeacher()
    {
        return $this->role === Role::teacher->name;
    }

    public function isParent()
    {
        return $this->role === Role::parents->name;
    }



}

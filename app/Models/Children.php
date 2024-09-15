<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Children extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'document',
        'gender',
        'status',
        'register_number',
        'photo',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(Classe::class);
    }

    public function childrenSubject(): HasMany
    {
        return $this->hasMany(ChildrenSubject::class);
    }
}

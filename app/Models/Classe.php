<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth; 

class Classe extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'photo',
        'period',
        'year',
        'stage'
    ];

    protected static function booted()
    {
        static::addGlobalScope('userClasses', function (Builder $builder) {
            $user = Auth::user();

            if ($user->role == \App\Enums\Role::teacher->name) {
                $builder->whereHas('subjects', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            }

            if ($user->role == \App\Enums\Role::parents->name) {
                $builder->whereHas('childrens', function ($query) use ($user) {
                    $query->where('user_id', $user->id); 
                });
            }
        });
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? false, fn ($query, $search) => $query->where('name', 'LIKE', "%$search%"));
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class)->using(ClasseSubject::class)->withPivot('user_id','id');
    }

    public function childrens(): BelongsToMany
    {
        return $this->belongsToMany(Children::class)->withPivot('id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    
}

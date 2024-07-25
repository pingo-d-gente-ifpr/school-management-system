<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'period',
        'stage'
    ];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }


}

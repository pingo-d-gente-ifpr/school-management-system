<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClasseSubject extends Pivot
{
    protected $table = 'classe_subject';
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    protected $fillable = ['class_id', 'subject_id', 'user_id'];
    public $timestamps = true;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function childrenSubject(): HasMany
    {
        return $this->hasMany(ChildrenSubject::class);
    }

    
    
}

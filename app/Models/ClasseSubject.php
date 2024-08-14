<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClasseSubject extends Pivot
{
    protected $table = 'classe_subject';

    protected $fillable = ['class_id', 'subject_id', 'user_id'];
    public $timestamps = true;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

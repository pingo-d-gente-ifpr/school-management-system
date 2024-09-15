<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChildrenSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'children_id',
        'classe_subject_id',
        'score1',
        'score2',
        'score3',
        'score4',
    ];

    public function children(): BelongsTo
    {
        return $this->belongsTo(Children::class);
    }

    public function classeSubject(): BelongsTo
    {
        return $this->belongsTo(ClasseSubject::class);
    }

}

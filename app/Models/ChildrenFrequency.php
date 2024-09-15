<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChildrenFrequency extends Model
{
    use HasFactory;
    protected $table = 'children_frequency';

    protected $fillable = [
        'children_classe_id',
        'date',
        'attendance'
    ];

    public function childrenClasse():BelongsTo
    {
        return $this->belongsTo(ChildrenClasse::class, 'children_classe_id');
    }

}

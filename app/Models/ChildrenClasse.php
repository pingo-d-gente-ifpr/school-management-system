<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ChildrenClasse extends Pivot
{
        /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    
    protected $table = 'children_classe';

    protected $fillable = ['classe_id','children_id'];
    
    public function frequencies(): HasMany
    {
        return $this->hasMany(ChildrenFrequency::class, 'children_classe_id');
    }
}

<?php

namespace App\Observers;

use App\Models\Children;
use Illuminate\Support\Facades\Storage;

class ChildrenObserver
{
    /**
     * Handle the Children "created" event.
     */
    public function updating(Children $children)
    {
        if($children->getOriginal('photo') && $children->getOriginal('photo') != $children->photo) {
            Storage::disk('public')->delete($children->getOriginal('photo'));
        }
    }
}

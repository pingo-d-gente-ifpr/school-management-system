<?php

namespace App\Observers;

use App\Models\Classe;
use Illuminate\Support\Facades\Storage;

class ClasseObserver
{
    /**
     * Handle the classe "created" event.
     */
    public function updating(Classe $classe)
    {
        if($classe->getOriginal('photo') && $classe->getOriginal('photo') != $classe->photo) {
            Storage::disk('public')->delete($classe->getOriginal('photo'));
        }
    }
}

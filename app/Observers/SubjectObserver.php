<?php

namespace App\Observers;

use App\Models\Subject;
use Illuminate\Support\Facades\Storage;

class SubjectObserver
{
    /**
     * Handle the User "created" event.
     */
    public function updating(Subject $subject)
    {
        if($subject->getOriginal('photo') && $subject->getOriginal('photo') != $subject->photo) {
            Storage::disk('public')->delete($subject->getOriginal('photo'));
        }
    }
}

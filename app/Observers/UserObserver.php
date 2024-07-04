<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function updating(User $user)
    {
        if($user->getOriginal('photo') && $user->getOriginal('photo') != $user->photo) {
            Storage::disk('public')->delete($user->getOriginal('photo'));
        }
    }
}

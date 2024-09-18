<?php

namespace App\Policies;

use App\Models\Classe;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ClassePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isTeacher() || $user->isParent();
    }

    /**
     * Determine if the user can view the class.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Class  $class
     * @return bool
     */
    public function view(User $user, Classe $classe)
    {   
        if ($user->isParent()) {
            $childrenIds = DB::table('childrens')
                ->where('user_id', $user->id)
                ->pluck('id');

            return DB::table('children_classe')
                ->whereIn('children_id', $childrenIds)
                ->where('classe_id', $classe->id)
                ->exists();
        }
        return $user->isAdmin() || DB::table('classe_subject')
        ->where('classe_id', $classe->id)
        ->where('user_id', $user->id)
        ->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Classe $classe): bool
    {
        return $user->isAdmin() || DB::table('classe_subject')
        ->where('classe_id', $classe->id)
        ->where('user_id', $user->id)
        ->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Classe $classe)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Classe $classe)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Classe $classe)
    {
        //
    }
}

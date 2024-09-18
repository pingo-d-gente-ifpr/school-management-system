<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Classe;
use App\Models\Subject;
use App\Models\User;
use App\Policies\ClassePolicy;
use App\Policies\SubjectPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Subject::class => SubjectPolicy::class,
        Classe::class => ClassePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}

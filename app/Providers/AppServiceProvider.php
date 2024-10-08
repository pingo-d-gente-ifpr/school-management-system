<?php

namespace App\Providers;

use App\Models\Children;
use App\Models\Classe;
use App\Models\Subject;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Observers\ChildrenObserver;
use App\Observers\ClasseObserver;
use App\Observers\SubjectObserver;
use App\Observers\UserObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Subject::observe(SubjectObserver::class);
        Children::observe(ChildrenObserver::class);
        Classe::observe(ClasseObserver::class);
    }
}

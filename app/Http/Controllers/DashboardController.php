<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChildrenSubject;
use App\Models\ClasseSubject;
use App\Models\Children;
use App\Enums\Role;

use App\Models\Classe;



class DashboardController extends Controller
{
    public function index(Classe $class)
    {
        $user = Auth::user();

        if ($user->role == Role::admin->name) {
            $classes = $class->paginate(6);
        }
        else if ($user->role == Role::teacher->name) {
            $classes = ClasseSubject::where('user_id', $user->id)
                                ->with('classe') 
                                ->get()
                                ->pluck('classe') 
                                ->unique();
        }
        else if ($user->role == Role::parents->name) {
            $classes = Children::where('user_id', $user->id)
                ->with('classes') 
                ->get()
                ->pluck('classes')
                ->flatten()  
                ->unique();  
        } 

        return view('dashboard', compact('classes'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;


class DashboardController extends Controller
{
    public function index()
    {
        $classes = Classe::paginate(6);

        return view('dashboard', ['classes' => $classes]);
    }
}

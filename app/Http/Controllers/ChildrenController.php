<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Children;
use App\Models\Classe;
use App\Models\ChildrenFrequency;
use App\Models\ChildrenSubject;
use Illuminate\Support\Facades\Auth;

class ChildrenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isParent()) {
            $children = $user->childrens()->paginate(6); // Corrigido para `childrens()`
        } else {
            $children = Children::paginate(6);
        }

        return view('front.children.index', compact('children'));
    }

    public function showFrequencies(Request $request, $id)
    {
        $child = Children::findOrFail($id);

        $classes = $child->classes; 

        // Obtenha os filtros da requisição
        $classId = $request->input('class_id'); 
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Construa a consulta com base nos filtros
        $query = ChildrenFrequency::whereIn('children_classe_id', function ($subQuery) use ($id, $classId) {
            $subQuery->select('id')
                ->from('children_classe')
                ->where('children_id', $id)
                ->when($classId, function ($subQuery) use ($classId) {
                    $subQuery->where('classe_id', $classId);
                });
        });

        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->whereDate('date', $startDate);
        }

        $frequencies = $query->paginate(10);

        return view('front.children.frequencies', compact('child', 'frequencies', 'classes'));
    }
    

    public function showGrades(Request $request, $id)
    {
        $child = Children::findOrFail($id);
        $classes = $child->classes;
    
        $classId = $request->input('class_id');
    
        $query = ChildrenSubject::where('children_id', $id)
            ->when($classId, function ($query) use ($classId) {
                $query->whereHas('classeSubject', function ($subQuery) use ($classId) {
                    $subQuery->where('classe_id', $classId); // Filtro pela turma
                });
            });
    
        $subjects = $query->get();
    
        return view('front.children.grades', compact('child', 'subjects', 'classes', 'classId'));
    }
    
}

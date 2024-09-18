<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChildrenSubjectRequest;
use App\Http\Requests\UpdateChildrenSubjectRequest;
use App\Models\ChildrenSubject;
use Illuminate\Http\Request;

class ChildrenSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChildrenSubjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ChildrenSubject $childrenSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChildrenSubject $childrenSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildrenSubjectRequest $request, ChildrenSubject $childrenSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildrenSubject $childrenSubject)
    {
        //
    }
}

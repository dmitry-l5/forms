<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormTemplate;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = FormTemplate::get();
        return view('forms.index', compact('templates') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FormTemplate $template)
    {

        return view( 'forms.create_form', compact('template') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormTemplate $template, Request $request)
    {
        dd($request->all(), $template);
    }

    /**
     * Display the specified resource.
     */
    public function show(FormTemplate $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

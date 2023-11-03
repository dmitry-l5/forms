<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormTemplate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class FormTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = FormTemplate::orderBy('created_at', 'DESC')->paginate(4);
        return view('forms_manage.templates_list', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms_manage.create_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'result_json'=>'required|json'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $validated = $validator->validate();
        $form_data = json_decode($validated['result_json']);
        $result = new \stdClass();

        $form = new FormTemplate();
        $form->author_id = Auth::user()->id;// ?? 1;
        $form->title = (isset($form_data->head->form_title))?$form_data->head->form_title:'заголовок';
        $form->description = (isset($form_data->head->form_description))?$form_data->head->form_description:'описание';
        $obj = new \stdClass();

        $form->data_json = json_encode($obj);
        $form->save();
        $form_data->aux->template_id =  $form->id;
        $form->data_json = json_encode($form_data);
        $form->save();

        return redirect(url('/manage/form_templates'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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

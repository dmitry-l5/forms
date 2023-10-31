<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormTemplate;

class FormTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = FormTemplate::orderBy('created_at', 'DESC')->paginate(4);
        return view('forms.templates_list', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.create_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        dd(json_decode($request->input('result_json')), $request->all());

        $form_data = json_decode($json_str);
        // $old_form = WorksheetTemplate::where(['id' => $form_data->id]);
        $new_form = WorksheetTemplate::where(['id'=>$form_data->aux->template_id])->first();
        //  dd('   ---   ', $form_data);
        //  dd('   ---   ', $new_form);
        $result = new \stdClass();
        if($new_form){
            $old_json = $new_form->data_json;
            $result = $this->compare_templates($old_json, $json_str);
        }else{
            $new_form = new WorksheetTemplate();
        }
        // dd('   ---   ', $form_data);
        $new_form->author_id = Auth::user()->id;
        $new_form->author = Auth::user()->name;
        $new_form->title = (isset($form_data->head->form_title))?$form_data->head->form_title:'заголовок';
        $new_form->description = (isset($form_data->head->form_description))?$form_data->head->form_description:'описание';
        $obj = new \stdClass();
        $obj->aux = (object)[];
        $obj->items = [];
        $new_form->data_json = json_encode($obj);
        $new_form->save();
        $form_data->aux->template_id =  $new_form->id;
        $new_form->data_json = json_encode($form_data);
        $new_form->save();
        // dd(json_decode($new_form->data_json));
        // dd($new_form);
        $result->template = $new_form;
        return $result;
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

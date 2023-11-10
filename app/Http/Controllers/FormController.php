<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormTemplate;
use App\Models\Answers;
use Illuminate\Support\Facades\Validator;


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
        // $validator = Validator::make($request->all(), [
        //     'form_data'=>['required','json'],
        // ]);
        // if ($validator->fails()){
        //     return back()->withErrors($validator)->withInput();
        // }
        $validated = $request->all();// $validator->validate();
        $data = $validated;
        unset($data['_token']);
        $answer = new Answers();
        $answer->ip = $request->ip();
        $answer->userAgent = $request->userAgent();
        $answer->template_id = $template->id;
        $answer->data = json_encode([$data]);
        $answer->additional_data = json_encode([]);
        $answer->save();
        return view('forms.thanks', []);
    }

    /**
     * Display the specified resource.
     */
    public function show(FormTemplate $form){
        $result = array();
        array_walk(json_decode($form->data_json)->items, 
        function($value, $key)use(&$result){
            switch($value->type){
                case 'header':
                    $result['header'] = $value;
                    break;
                case 'checkbox_group':
                    $value->result = clone $value->options;
                    foreach($value->result as $key => $option){$value->result->{$key} = 0;}
                    $result[$value->input_name ?? ''] = $value;
                    break;
                default:
                    if(isset($value->input_name)){
                        $value->result = null;
                        $result[$value->input_name ?? ''] = $value;
                    }
                    break;
            }
        });
        $result = (object)$result;
        $answers = Answers::where(['template_id'=>$form->id])->get();
        array_map(function($item)use($form, &$result){
            array_walk(json_decode($item['data'], false)[0], 
            function($value, $key)use(&$result){
                switch($result->{$key}->type){
                    case 'checkbox_group':
                        foreach((array)$value as $input_name => $input_value){
                            $result->{$key}->result->{$input_name} ?? $result->{$key}->result->{$input_name} = 0;
                            $result->{$key}->result->{$input_name} += 1;
                        }
                        // $result->{$key}->
                        break;
                    case 'date':
                    case 'number':
                    case 'string':
                        // dd($result->{$key}->result, $value);
                        $result->{$key}->result ?? array();
                        $result->{$key}->result[] = $value;
                        break;
                    default:
                        echo($result->{$key}->type.'</br>');
                        break;
                }
            });
        },$answers->toArray());
        return view('forms.viewer', compact('form','result'));
        //dd($result, json_decode($form->data_json), $answers->toArray(), $answers);
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
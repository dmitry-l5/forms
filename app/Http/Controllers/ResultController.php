<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormTemplate;
use App\Models\Answers;
use Barryvdh\DomPDF\Facade\Pdf;

class ResultController extends Controller{
    public function show(Request $request, string $template_id, int $viewer_id = 0){
        $template = FormTemplate::where(['uuid'=>$template_id])->first();
        if(!$template){return abort(404);}
        // Answers::where()->get();
        $result = $this->collect_answers($template);
        //dd('after collect data',$template, $template_id, $viewer_id);
        // $form = json_decode($template->data_json, false);
        $alias = $template_id;
        switch($viewer_id){
            case 1:
                $pdf = Pdf::loadView('pdf.result', compact('result', 'alias'));
                return $pdf->stream();

        }
        return view('forms.result', compact('result', 'alias'));
    }
    private function collect_answers($template){
        $form = json_decode($template->data_json);
        $data = $template->answers->map(function(Answers $answers){
            return json_decode($answers->data);
        });
        $result = (object)[];
// dd($form->items);
        array_walk($form->items, function($field, $key)use(&$result, $data){
            if(isset($field->input_name)){
                $result->{$field->input_name} = [];
                // echo($field->input_name."</br>");
                if(isset($field->options)){
                    $input_name = $field->input_name;
                    $result->{$input_name} = (object)[];
                    foreach($field->options as $name => $title){
                        // echo("   !!!   ".$input_name."</br>");
                        $result->{$input_name}->{$name} = 0;
                        $count = 0;
                        $custom = array();
                        $answers = $data->toArray();
                        array_walk($answers, function($item)use(&$count, $input_name, $name, &$custom){
                            if($item->{$input_name}->{$name} ?? false){
                                // echo("<br>mark : ".$count."<br>");
                                if(is_bool($item->{$input_name}->{$name}) && $item->{$input_name}->{$name}){
                                    $count++;
                                }else{
                                    $custom[] = $item->{$input_name}->{$name};
                                }
                            }
                        });
                        $result->{$field->input_name}->{$name} = $count;
                        // echo("   -   ".$name."</br>");
                    }
                }elseif($field->type == 'checkbox'){
                    $count = 0;
                    $answers = $data->toArray();
                    array_walk($answers, function($input, $key)use(&$count, $field){
                        if($input->{$field->input_name ?? false}){
                            $count++;
                        };
                        // dd($count, $input, $field);
                    });
                    $result->{$field->input_name} = $count;
                    // dd('else',$result,  $field, $field->input_name, $key);
                }elseif($field->type == 'textarea'){
                    $count = 0;
                    $answers = $data->toArray();
                    $answers_arr = [];
                    // dd($answers);
                    array_walk($answers, function($input, $key)use(&$count, $field, &$answers_arr){
                       // dd($input);
                        if(isset($input->{$field->input_name})){
                            $answers_arr[] = $input->{$field->input_name};
                            $count++;
                        };
                        // dd($count, $input, $field);
                    });
                    $result->{$field->input_name} = (object)['count'=>$count, 'answers'=>$answers_arr];

                }else{
                    return abort(404);
                    dd('error');
                }
            }else{
                // echo($field->type."</br>");
            }
        });
        $form_items = array_map(function($item)use($result){
            if(
                isset($item->input_name) &&
                ($result->{$item->input_name} ?? false)
            ){
                if(isset($item->options)){
                    $item->result = (object)[];
                    foreach($item->options as $name=>$option){
                        $item->result->{$option} = $result->{$item->input_name}->{$name};
                        //  echo($name.'   :::   '.$option.'<br>');
                    }
                }else{
                    $item->result = (object)[ $item->title => $result->{$item->input_name}];
                }
                $item->result_raw = $result->{$item->input_name};
            }
            return $item;
        }, $form->items );
        $result_form = (object)[
            'data'=>(object)['template_id'=>$template->id, 'count'=>count($data)],
            'items'=>$form_items,
        ];
        // dd($result_form, $form_items, $result);
        return $result_form;
    }
}

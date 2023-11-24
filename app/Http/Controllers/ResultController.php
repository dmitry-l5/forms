<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormTemplate;
use App\Models\Answers;

class ResultController extends Controller
{
    public function show(Request $request, string $template_id, int $viewer_id = 0){
        $template = FormTemplate::where(['alias_id'=>$template_id])->first();
        if(!$template){return abort(404);}
        // Answers::where()->get();
        $result = $this->collect_answers($template);
        dd('after collect data',$template, $template_id, $viewer_id);
        return null;
    }
    private function collect_answers($template){
        $form = json_decode($template->data_json);
        $data = $template->answers->map(function(Answers $answers){
            return json_decode($answers->data);
        });
        $result = (object)[];     
dd($form->items);
        array_walk($form->items, function($field, $key)use(&$result, $data){
            if(isset($field->input_name)){
                $result->{$field->input_name} = [];
                echo($field->input_name."</br>");
                if(isset($field->options)){
                    $input_name = $field->input_name;
                    $result->{$input_name} = (object)[];
                    foreach($field->options as $name => $title){
                        $result->{$input_name}->{$name} = 0;
                        $count = 0;
                        $custom = array();
                        $answers = $data->toArray();
                        array_walk($answers, function($item)use(&$count, $input_name, $name, &$custom){
                            if($item->{$input_name}->{$name} ?? false){
                                echo("<br>mark : ".$count."<br>");
                                if(is_bool($item->{$input_name}->{$name}) && $item->{$input_name}->{$name}){
                                    $count++;
                                }else{
                                    $custom[] = $item->{$input_name}->{$name};
                                }
                            }
                        });
                        $result->{$field->input_name}->{$name} = $count;
                        echo("   -   ".$name."</br>");
                    }
                }elseif($field->type == 'checkbox'){
                    $count = 0;
                    $answers = $data->toArray();
                    array_walk($answers, function($input, $key)use(&$count){

                    });
                    $result->{$field->input_name} = $count;
                    dd('else',$result,  $field, $field->input_name, $key);
                }else{
                    dd('hello');
                }
            }else{
                echo($field->type."</br>");
            }
        });
        
        dd($result, $form->items, $data);
       
        return '';
    }
}
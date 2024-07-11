<?php
    $data = [
        ['quantity'=> 9, 'description'=>'10101010','price'=>'123'],
        ['quantity'=> 11, 'description'=>'21212121','price'=>'456'],
        ['quantity'=> 12, 'description'=>'23232323','price'=>'789'],
        ['quantity'=> 13, 'description'=>'34343434','price'=>'1ss'],

    ];
    ?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="css/pdf/result_1.css'">
    <style>
        body{
            font-family: 'dejavu serif';
        }
        .answer_def{
        }
        .w_100{
            width: 100%;
        }
        .w_50{
            width: 50%;
        }
        .text_end{
            text-align: end;
        }
        .border_bottom{
            border-bottom: 1px solid black ;
        }
        table{
            border-collapse: collapse;
        }
        .header{
            text-align: center;
        }
        .description{
            padding-bottom: 3em;
        }
        .item_header{
            font-weight: 700;
            text-align: center;
        }
    </style>
</head>
<body>
    @php
        $header = array_filter(
            $result->items,
            function($item){
                return ( $item->type == 'header' )?true:false;
            }
        )[0] ?? null;
    @endphp
    <div class="text-center mb-6">
        <div class="border border-sky-600 p-5 bg-sky-50">
            Учитываются ответы полученные с момента последнего изменения содержания формы
            <span class="font-bold">
                {{ date('d.m.Y H:i', strtotime($template->updated_at)) }}
            </span>
        </div>
    </div>
    <div class="header">
        <h1>{{ $header->title ?? '#title' }}</h1>
    </div>
    <div class="description">
        <span>{{ $header->description ?? '#description' }}</span>
    </div>
    <div class="">
        @foreach ($result->items as $item)
        @switch($item->type)
            @case('header')
                @break
            @case('textarea')
                @php($varr = true)
                <x-ResultTextarea :data='$item' :pdf='true'></x-ResultTextarea>
                @break
            @default
                <div class="answer_def ">
                    <div class="">
                        <div class="item_header">{{  $item->title  }}</div>
                        <div class="">{{  $item->description  }}</div>
                    </div>
                    <table class="w_100 ">
                        <tbody>
                            @if(!empty($item->result))
                                @foreach ($item->result as $key => $value)
                                <tr >
                                    <td class="w_50 border_bottom">
                                        <span class="">{{ $key }}</span>
                                    </td>
                                    <td class="w_50 border_bottom">
                                        <div class="w_100 text_end">
                                            <span class="">{{ $value }}</span>/<span class="">{{ $result->data->count }}</span>
                                            ( <span class="">{{ $result->data->count?($value/$result->data->count )*100:0 }}%</span> )
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            @endswitch
        @endforeach
    </div>
</body>

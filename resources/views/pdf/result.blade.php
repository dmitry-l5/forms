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
    <link rel="stylesheet" href="css/pdf/result_1.css"> 
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
    <div class="header">
        <span>{{ $header->title ?? '#title' }}</span>
    </div>
    <div class="description">
        <span>{{ $header->description ?? '#description' }}</span>
    </div>
    @foreach ($result->items as $item)
    @switch($item->type)
        @case('header')
            @break
        @case('textarea')
            <x-ResultTextarea :pdf='1' :data='$item'></x-result_textarea>
            @break
        @default
            <x-result_base title="{{  $item->title  }}" description="{{  $item->description  }}">
                @if(isset($item->result))
                    @foreach ($item->result as $key => $value)
                        <x-result_line class="py-1" x-data="{ total:{{ $result->data->count }}, count:{{ $value }}, title:'{{  (count((array)$item->result)>1)?$key:null }}' }" percent="{{ $result->data->count?($value/$result->data->count )*100:0 }}"></x-result_line>
                    @endforeach
                @endif
            </x-result_base>   
    @endswitch
@endforeach
</body>
</html>
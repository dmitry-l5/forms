
<!doctype html>
<html lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Links</title>
        <style>
            body{
                font-family: 'dejavu serif';
            }
            table{
                border-collapse: collapse;
                width: 100%;
            }
            td{
                padding: 5px;
                border: 1px rgb(109, 109, 109) dotted;
            }
            h1{
                text-align: center;
            }
        </style>
</head>
<body>
    @php
        $data = json_decode($template->data_json, false);
        $header = '';
        array_walk($data->items, function($item, $key)use(&$header){
            if($item->type == 'header'){
                $header = $item->title;
            }
        })
    @endphp
    <h1>
        {{ $header }}
    </h1>

    <table class="">
        <thead>
            <tr>
                <th>{{__("Link")}}</th>
                <th>{{__('Alias')}}</th>
                <th>{{__('Began') }}</th>
                <th>{{__('Complete')}}</th>
                <th>{{__('Canceled')}}</th>
                <th>{{__('Used')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $links as $link)
            <tr>
                <td> {{ url("worksheet/$template->uuid/$link->alias") }}</td>
                <td>{{ $link->alias }}</td>
                <td>{{ $link->began      ?__('Yes'):__('No')}}</td>
                <td>{{ $link->complete   ?__('Yes'):__('No')}}</td>
                <td>{{ $link->canceled   ?__('Yes'):__('No')}}</td>
                <td>{{ $link->used       ?__('Yes'):__('No')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

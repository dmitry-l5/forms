<?php
    $data = [
        ['quantity'=> 9, 'description'=>'10101010','price'=>'123'],
        ['quantity'=> 11, 'description'=>'21212121','price'=>'456'],
        ['quantity'=> 12, 'description'=>'23232323','price'=>'789'],
        ['quantity'=> 13, 'description'=>'34343434','price'=>'1ss'],

    ];
    ?>
<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Invoice</title>
        <!-- <link rel="stylesheet" href="{{ asset('css/pdf/test.css'); }}">  -->
    </head>
    <body>
        <div class="oppa">
           OPPA
        </div>
    <table class="w-full">
        <tr>
            <td class="w-half">

            </td>
            <td class="w-half">
                <h2>Invoice ID: 834847473</h2>
            </td>
        </tr>
    </table>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><h4>To:</h4></div>
                    <div>John Doe</div>
                    <div>123 Acme Str.</div>
                </td>
                <td class="w-half">
                    <div><h4>From:</h4></div>
                    <div>Laravel Daily</div>
                    <div>London</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="margin-top">
        <table class="products">
            <tr>
                <th>Qty</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
            @foreach($data as $item)
            <tr class="items">
                    <td>
                        {{ $item['quantity'] }}
                    </td>
                    <td>
                        {{ $item['description'] }}
                    </td>
                    <td>
                        {{ $item['price'] }}
                    </td>
                </tr>
                @endforeach
        </table>
    </div>

    <div class="total">
        Total: $129.00 USD
    </div>

    <div class="footer margin-top">
        <div>Thank you</div>
        <div>&copy; Laravel Daily</div>
    </div>
</body>
</html>

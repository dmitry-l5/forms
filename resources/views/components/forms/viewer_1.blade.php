<div {{ $attributes->merge(['class'=>'border border-black my-1'])->filter(fn ($value, $key) => !in_array($key, ['items'])) }}>

    @foreach ($items as $key=>$item )
        @switch($item->type)
            @case('header')
                <div class="border p-4 text-center">
                    <h3 class='text-2xl'>{{ $item->title }}</h3>
                    <h5>{{ $item->description }}</h5>
                </div>
                @break
            @default
                <div class="border p-4 bg-green-200">
                    <h3 class='text-xl'>{{ $item->title }}</h3>
                    <h5>{{ $item->description }}</h5>
                </div>
                @if (isset($item->options))
                    @foreach ($item->options as $key=>$value)
                        <div class="">
                            <span>{{ $value }} : </span><span>{{ $item->result->{$key} }}</span>
                        </div>
                    @endforeach
                @elseif (is_array($item->result))
                        <span>{{ implode('; ', $item->result).'.' }}</span>
                @endif
        @endswitch
    @endforeach
</div>
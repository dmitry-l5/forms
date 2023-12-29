<div x-data="{open : false, is_pdf:{{ $pdf ?? false }}}" class="border border-1 border-sky-700 bg-white my-4 py-2 pt-0 " >
    @if ($pdf)
        <div class="w-100">
            <div class="w-100 text-center title">{{ $title ?? '#' }}</div>
            <div class="w-100 description">{{ $description ?? '#' }}</div>
        </div>
        <div class="">
            <div class="">
                Всего дано {{ count((array)$answers) }} ответов
            </div>
            <ul class="">
                @foreach ($answers as $answer )
                <li class=''>{{ $answer."; " }}</li>
                @endforeach
            </ul>
        </div>
    @else
        <div x-on:click="open = !open" class=" flex justify-between bg-sky-100 text-start px-4 border-b border-neutral-300 text-black font-semibold " title="{{ $description ?? '' }}">
            <div>
                {{ $title }}
            </div>
            <div x-show="open" class="text-2xl font-bold flex">
                <div class="-rotate-90">&raquo</div>
                <div class="-rotate-90">&raquo</div>
                <div class="-rotate-90">&raquo</div>
            </div>
            <div x-show="!open" class="text-2xl font-bold flex">
                <div class="rotate-90">&raquo</div>
                <div class="rotate-90">&raquo</div>
                <div class="rotate-90">&raquo</div>
            </div>
        </div>
        <div x-show="!open" class="ps-8">
            Всего дано {{ count((array)$answers) }} ответов
        </div>
        <ul x-show="open" class="ps-8 list-disc">
            @foreach ($answers as $answer )
            <li class=''>{{ $answer."; " }}</li>
            @endforeach
        </ul>
    @endif
    <div class="">
        {{ $slot }}
    </div>
</div>